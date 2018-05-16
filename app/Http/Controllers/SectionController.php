<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Section;
use App\Division;

class SectionController extends Controller
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
         $sections = DB::table('section')
        ->leftJoin('division', 'section.division_id', '=', 'division.id')
        ->select('section.id', 'section.name', 'division.name as division_name', 'division.id as division_id')
        ->paginate(5);
        return view('system-mgmt/section/index', ['sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('system-mgmt/section/create', ['divisions' => $divisions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Division::findOrFail($request['division_id']);
        $this->validateInput($request);
         Section::create([
            'name' => $request['name'],
            'division_id' => $request['division_id']
        ]);

        return redirect()->intended('system-management/section');
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
        $section = Section::find($id);
        // Redirect to section list if updating section wasn't existed
        if ($section == null || count($section) == 0) {
            return redirect()->intended('/system-management/section');
        }

        $divisions = Division::all();
        return view('system-mgmt/section/edit', ['section' => $section, 'divisions' => $divisions]);
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
        $section = section::findOrFail($id);
         $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        $input = [
            'name' => $request['name'],
            'division_id' => $request['division_id']
        ];
        section::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/section');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        section::where('id', $id)->delete();
         return redirect()->intended('system-management/section');
    }

    public function loadsections($divisionId) {
        $sections = section::where('division_id', '=', $divisionId)->get(['id', 'name']);

        return response()->json($sections);
    }

    /**
     * Search section from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $sections = $this->doSearchingQuery($constraints);
       return view('system-mgmt/section/index', ['sections' => $sections, 'searchingVals' => $constraints]);
    }
    
    private function doSearchingQuery($constraints) {
        $query = section::query();
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
        'name' => 'required|max:60|unique:section'
    ]);
    }
}
