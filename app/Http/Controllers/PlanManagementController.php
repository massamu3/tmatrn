<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Plan;
use App\Employee;
use App\Program;


// employee_id program_id  startdate   progmod pcost


class PlanManagementController extends Controller
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
    $plans = Plan::orderBy('id', 'DESC')->with('employees', 'programs')->paginate(10); //Load variable from model
        //return $plans;
    return view('plans-mgmt/index', ['plans' => $plans]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Variable zote kwenye fomu lazima zitengenezwe hapa kisha ziitwe
    {

        $employees = Employee::pluck('lastname', 'firstname', 'middlename','id');
        $programs = Program::pluck('name','id');



        //return $sections;
        return view('plans-mgmt/create',
         ['employees' => $employees,
         'programs' => $programs

       ]); // all to be included in the array for them to load in the combo box, this hii ndion inayochukua kwenye model iliyounganishwa na database
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
        $keys = ['employee_id', 'program_id', 'startdate','progmod','ifattend', 'pcost'];



        $input = $this->createQueryInput($keys, $request);
        Plan::create($input);
        return redirect()->intended('/plan-management');
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
        $plan = Plan::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($plan == null || count($plan) == 0) {
            return redirect()->intended('/plan-management');
        }
        $employees = employee::all();
        $programs = program::all();


        return view('plans-mgmt/edit', 
            ['plan' => $plan, 
            'programs' => $programs]);
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
        $plan = Plan::findOrFail($id);
        $this->validateInput($request);
 
    $keys = ['employee_id', 'program_id', 'startdate', 'progmod','ifattend', 'pcost'];
    $input = $this->createQueryInput($keys, $request);
        Plan::where('id', $id)
        ->update($input);
// employee_id program_id  startdate   progmod pcost
        return redirect()->intended('/plan-management');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     plan::where('id', $id)->delete();
     return redirect()->intended('/plan-management');
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
        $plans = $this->doSearchingQuery($constraints);
        $constraints['designation_name'] = $request['designation_name'];
        return view('plans-mgmt/index', ['plans' => $plans, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('plans')
        ->leftJoin('section', 'plans.section_id', '=', 'section.id')
        ->leftJoin('designation', 'plans.designation_id', '=', 'designation.id')
        ->leftJoin('division', 'plans.division_id', '=', 'division.id')
        ->leftJoin('station', 'plans.station_id', '=', 'station.id')
        ->leftJoin('division', 'plans.division_id', '=', 'division.id')
        ->leftJoin('status', 'plans.status_id', '=', 'status.id')

        ->select('plans.firstname as plan_name', 'plans.*','designation.name as designation_name', 'designation.id as designation_id', 'division.name as division_name', 'division.id as division_id');
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

    private function validateInput($request) {
        $this->validate($request, [
           'employee_id' => 'required',
           'program_id' => 'required'

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