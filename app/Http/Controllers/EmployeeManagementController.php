<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Employee;
use App\Section;
use App\Division;
use App\Station;
use App\Status;
use App\Designation;


class EmployeeManagementController extends Controller
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

        $employees = Employee::orderBy('id', 'DESC')->with('stations', 'divisions')->paginate(10); //others can be added here
        //return $employees;
        return view('employees-mgmt/index', ['employees' => $employees]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //Variable zote kwenye fomu lazima zitengenezwe hapa kisha ziitwe
    {
        // $cities = section::all();
        // $divisions = division::all();
        $stations = Station::pluck('name','id');
        $designations = Designation::pluck('name','id');
        $statuss = Status::pluck('name','id');
        $divisions = Division::pluck('name','id');
        $sections = Section::pluck('name','id');

        //return $sections;
        return view('employees-mgmt/create',
           ['stations' => $stations,
           'designations' => $designations, 'statuss' => $statuss, 'divisions'=> $divisions, 'sections'=> $sections
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
        // Upload image
        $path = $request->file('picture')->store('avatars');
        $keys = ['name_all', 'chequeno', 'sex', 'schemeservice','section_id', 'division_id', 'station_id', 'birthdate', 'date_hired', 'designation_id', 'status_id', 'division_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['picture'] = $path;
        // Not implement yet
        // $input['company_id'] = 0;
        Employee::create($input);

        return redirect()->intended('/employee-management');
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
        $employee = Employee::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($employee == null || count($employee) == 0) {
            return redirect()->intended('/employee-management');
        }
        $sections = section::all();
        $divisions = division::all();
        $stations = station::all();
        $designations = designation::all();
        $divisions = division::all();
        $statuss = status::all();
        return view('employees-mgmt/edit', 
            ['employee' => $employee, 
            'sections' => $sections,
            'stations' => $stations,
            'statuss' => $statuss,
            'designations' => $designations,
            'divisions' => $divisions]);
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
        $employee = Employee::findOrFail($id);
        $this->validateInput($request);
        // Upload image
    $keys = ['name_all', 'chequeno','sex','birthdate', 'date_hired','designation_id', 'status_id','schemeservice', 'station_id', 'division_id', 'section_id'];
        $input = $this->createQueryInput($keys, $request);
        if ($request->file('picture')) {
            $path = $request->file('picture')->store('avatars');
            $input['picture'] = $path;
        }

        Employee::where('id', $id)
        ->update($input);

        return redirect()->intended('/employee-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Employee::where('id', $id)->delete();
       return redirect()->intended('/employee-management');
   }

    /**
     * Search division from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'firstname' => $request['firstname'], // search name_all itatumika
            'designation.name' => $request['designation_name']
        ];
        $employees = $this->doSearchingQuery($constraints);
        $constraints['designation_name'] = $request['designation_name'];
        return view('employees-mgmt/index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('employees')

        ->leftJoin('section', 'employees.section_id', '=', 'section.id')
        ->leftJoin('designation', 'employees.designation_id', '=', 'designation.id')
        ->leftJoin('division', 'employees.division_id', '=', 'division.id')
        ->leftJoin('station', 'employees.station_id', '=', 'station.id')
        ->leftJoin('division', 'employees.division_id', '=', 'division.id')
        ->leftJoin('status', 'employees.status_id', '=', 'status.id')

        ->select('employees.firstname as employee_name', 'employees.*','designation.name as designation_name', 'designation.id as designation_id', 'division.name as division_name', 'division.id as division_id');
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
        'name_all' => 'required|max:200',
        'station_id' => 'required',
        'birthdate' => 'required',
        'date_hired' => 'required',
        'designation_id' => 'required',
        'division_id' => 'required'
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
