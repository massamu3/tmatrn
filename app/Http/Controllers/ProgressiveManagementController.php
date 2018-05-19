<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Progressive;
use App\Transaction;
use App\Employee;
use App\School;
use App\Program;


class ProgressiveManagementController extends Controller
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
    $progressives = Progressive::orderBy('id', 'DESC')->with('employees', 'programs','schools')->paginate(10); //Load variable from model
        //return $progressives;
    return view('progressives-mgmt/index', ['progressives' => $progressives]);
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Variable zote kwenye fomu lazima zitengenezwe hapa kisha ziitwe
    {
        // Read how to attach
        $employees = Employee::pluck('name_all','id');
        $programs = Program::pluck('name','id');
        $schools = School::pluck('name','id');

 


        //return $sections;
        return view('progressives-mgmt/create',
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
        $keys = ['transaction_id', 'attach_cert', 'remarks', 'flag'];

        $input = $this->createQueryInput($keys, $request);
        Progressive::create($input);
        return redirect()->intended('/progressive-management');
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
        $progressive = Progressive::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($progressive == null || count($progressive) == 0) {
            return redirect()->intended('/progressive-management');
        }
        $employees = employee::all();
        $programs = program::all();
        $schools = school::all();
      

        return view('progressives-mgmt/edit', 
            ['progressive' => $progressive, 
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
        $progressive = Progressive::findOrFail($id);
        $this->validateInput($request);
 
    $keys = ['progressive_id', 'employee_id', 'school_id', 'status2', 'lasttrnperiod', 'startdate','enddate', 'progmode'];
    $input = $this->createQueryInput($keys, $request);
        Progressive::where('id', $id)
        ->update($input);
// id  name_all      // id  transaction_id  attach_cert remarks flag 
        return redirect()->intended('/progressive-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     progressive::where('id', $id)->delete();
     return redirect()->intended('/progressive-management');
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
        $progressives = $this->doSearchingQuery($constraints);
        $constraints['designation_name'] = $request['designation_name'];
        return view('progressives-mgmt/index', ['progressives' => $progressives, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('progressives')
        ->leftJoin('section', 'progressives.section_id', '=', 'section.id')
        ->leftJoin('designation', 'progressives.designation_id', '=', 'designation.id')
        ->leftJoin('division', 'progressives.division_id', '=', 'division.id')
        ->leftJoin('station', 'progressives.station_id', '=', 'station.id')
        ->leftJoin('division', 'progressives.division_id', '=', 'division.id')
        ->leftJoin('status', 'progressives.status_id', '=', 'status.id')

        ->select('progressives.firstname as progressive_name', 'progressives.*','designation.name as designation_name', 'designation.id as designation_id', 'division.name as division_name', 'division.id as division_id');
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
           'progressive_id' => 'required',
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