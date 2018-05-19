<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Academiclevel;
use App\Employee;
use App\Program;
use App\Academic;


class AcademiclevelManagementController extends Controller
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
    $academiclevels = Academiclevel::orderBy('id', 'DESC')->with('employees', 'programs','academics')->paginate(10); //Load variable from model
        //return $academiclevels;
    return view('academiclevels-mgmt/index', ['academiclevels' => $academiclevels]);
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
        $academics = Academic::pluck('name','id');


        //return $sections;
        return view('academiclevels-mgmt/create',
         ['employees' => $employees,
         'programs' => $programs,
          'academics' => $academics,  

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
        $keys = ['employee_id','academic_id', 'program_id', 'timeperiod'];

        $input = $this->createQueryInput($keys, $request);
        Academiclevel::create($input);
        return redirect()->intended('/academiclevel-management');
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
        $academiclevel = Academiclevel::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($academiclevel == null || count($academiclevel) == 0) {
            return redirect()->intended('/academiclevel-management');
        }
        $employees = employee::all();
        $programs = program::all();
        $academics = Academic::all();
      

        return view('academiclevels-mgmt/edit', 
            ['academiclevel' => $academiclevel, 
            'programs' => $programs,
            'academics' => $academics]);
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
        $academiclevel = Academiclevel::findOrFail($id);
        $this->validateInput($request);
 
    $keys = ['employee_id', 'program_id', 'academic_id', 'timeperiod','gpa', 'qualification','remarks'];
    $input = $this->createQueryInput($keys, $request);
        Academiclevel::where('id', $id)
        ->update($input);

        return redirect()->intended('/academiclevel-management');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     academiclevel::where('id', $id)->delete();
     return redirect()->intended('/academiclevel-management');
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
        $academiclevels = $this->doSearchingQuery($constraints);
        $constraints['designation_name'] = $request['designation_name'];
        return view('academiclevels-mgmt/index', ['academiclevels' => $academiclevels, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('academiclevels')
        ->leftJoin('section', 'academiclevels.section_id', '=', 'section.id')
        ->leftJoin('designation', 'academiclevels.designation_id', '=', 'designation.id')
        ->leftJoin('division', 'academiclevels.division_id', '=', 'division.id')
        ->leftJoin('station', 'academiclevels.station_id', '=', 'station.id')
        ->leftJoin('division', 'academiclevels.division_id', '=', 'division.id')
        ->leftJoin('status', 'academiclevels.status_id', '=', 'status.id')

        ->select('academiclevels.firstname as academiclevel_name', 'academiclevels.*','designation.name as designation_name', 'designation.id as designation_id', 'division.name as division_name', 'division.id as division_id');
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