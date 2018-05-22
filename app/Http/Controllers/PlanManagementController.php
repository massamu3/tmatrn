<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Plan;
use App\Employee;
use App\Program;
use App\Academic;
use App\School;


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
    $plans = Plan::orderBy('id', 'DESC')->with('employees', 'programs','academics','schools')->paginate(10); //Load variable from model
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

        $employees = Employee::pluck('name_all','id');
        $programs = Program::pluck('name','id');
        $programs = Academic::pluck('name','id');
        $schools = School::pluck('name','id');



        //return $sections;
        return view('plans-mgmt/create',
         ['employees' => $employees,
         'programs' => $programs, 
         'academics' => $programs, 
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
      $keys = ['employee_id', 'program_id', 'academic_id','school_id', 'startdate', 'progmod', 'ifattend','pcost'];

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
        $academics = academic::all();
        $schools = school::all();
    

        return view('plans-mgmt/edit', 
            ['plan' => $plan, 
            'programs' => $programs,
            'employees' => $employees,
            'academics' => $academics,
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
        $plan = Plan::findOrFail($id);
        $this->validateInput($request);
 
    $keys = ['employee_id', 'program_id','academic_id', 'school_id', 'startdate', 'progmod','ifattend', 'pcost'];
    $input = $this->createQueryInput($keys, $request);
        Plan::where('id', $id)
        ->update($input);

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
           'startdate' => 'required|max:60',
           'progmod' => 'required|max:60'
   
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