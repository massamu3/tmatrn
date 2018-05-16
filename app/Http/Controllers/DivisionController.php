<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Division;
use App\Station;

class DivisionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(["index", "create", "store", "edit", "update", "search", "destroy"]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $divisions = DB::table('division')
        ->leftJoin('station', 'division.station_id', '=', 'station.id')
        ->select('division.id', 'division.name', 'station.name as station_name', 'station.id as station_id')
        ->paginate(5);
        return view('system-mgmt/division/index', ['divisions' => $divisions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stations = Station::all();
        return view('system-mgmt/division/create', ['stations' => $stations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Station::findOrFail($request['station_id']);
        $this->validateInput($request);
         Division::create([
            'name' => $request['name'],
            'station_id' => $request['station_id']
        ]);

        return redirect()->intended('system-management/division');
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
        $division = division::find($id);
        // Redirect to division list if updating division wasn't existed
        if ($division == null || count($division) == 0) {
            return redirect()->intended('/system-management/division');
        }

        $stations = Station::all();
        return view('system-mgmt/division/edit', ['division' => $division, 'stations' => $stations]);
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
        $division = division::findOrFail($id);
         $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        $input = [
            'name' => $request['name'],
            'station_id' => $request['station_id']
        ];
        division::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/division');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        division::where('id', $id)->delete();
         return redirect()->intended('system-management/division');
    }

    public function loaddivisions($stationId) {
        $divisions = division::where('station_id', '=', $stationId)->get(['id', 'name']);

        return response()->json($divisions);
    }
    
    /**
     * Search division from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $divisions = $this->doSearchingQuery($constraints);
       return view('system-mgmt/division/index', ['divisions' => $divisions, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = division::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:division'
    ]);
    }
}
