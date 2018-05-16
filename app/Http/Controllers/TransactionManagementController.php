<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Transaction;
use App\Employee;
use App\School;
use App\Program;


class TransactionManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $transactions = Transaction::orderBy('id', 'DESC')->with('employees', 'programs','schools')->paginate(10); //Load variable from model
        //return $transactions;
    return view('transactions-mgmt/index', ['transactions' => $transactions]);
}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Variable zote kwenye fomu lazima zitengenezwe hapa kisha ziitwe
    {

        $employees = Employee::pluck('name','id');
        $programs = Program::pluck('name','id');
        $schools = School::pluck('name','id');


        //return $sections;
        return view('transactions-mgmt/create',
         ['employees' => $employees,
         'programs' => $programs, 
         'schools' => $schools
       ]); // all to be included in the array
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $this->validateInput($request);
        $keys = ['employee_id', 'program_id', 'school_id', 'status2', 'lasttrnperiod', 'startdate','enddate', 'progmode'];

        $input = $this->createQueryInput($keys, $request);
        Transaction::create($input);
        return redirect()->intended('/transaction-management');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($transaction == null || count($transaction) == 0) {
            return redirect()->intended('/transaction-management');
        }
        $employees = employee::all();
        $programs = program::all();
        $schools = school::all();
      

        return view('transactions-mgmt/edit', 
            ['transaction' => $transaction, 
            'programs' => $programs,
            'schools' => $schools]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $this->validateInput($request);
 
    $keys = ['employee_id', 'program_id', 'school_id', 'status2', 'lasttrnperiod', 'startdate','enddate', 'progmode'];
    $input = $this->createQueryInput($keys, $request);
        Transaction::where('id', $id)
        ->update($input);

        return redirect()->intended('/transaction-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     transaction::where('id', $id)->delete();
     return redirect()->intended('/transaction-management');
 }

    /**
     * Search division from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'firstname' => $request['firstname'],
            'designation.name' => $request['designation_name']
        ];
        $transactions = $this->doSearchingQuery($constraints);
        $constraints['designation_name'] = $request['designation_name'];
        return view('transactions-mgmt/index', ['transactions' => $transactions, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('transactions')
        ->leftJoin('section', 'transactions.section_id', '=', 'section.id')
        ->leftJoin('designation', 'transactions.designation_id', '=', 'designation.id')
        ->leftJoin('division', 'transactions.division_id', '=', 'division.id')
        ->leftJoin('station', 'transactions.station_id', '=', 'station.id')
        ->leftJoin('division', 'transactions.division_id', '=', 'division.id')
        ->leftJoin('status', 'transactions.status_id', '=', 'status.id')

        ->select('transactions.firstname as transaction_name', 'transactions.*','designation.name as designation_name', 'designation.id as designation_id', 'division.name as division_name', 'division.id as division_id');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

     /**
     * Load image resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
     public function load($name) {
         $path = storage_path().'/app/avatars/'.$name;
         if (file_exists($path)) {
            return Response::download($path);
        }
    }

    private function validateInput($request) {
        $this->validate($request, [
           'employee_id' => 'required',
           'program_id' => 'required',
           'lasttrnperiod' => 'required|max:60',
           'progmode' => 'required|max:60'

        ]);
    }

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}