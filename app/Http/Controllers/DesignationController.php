<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Designation;

//use Controller;

class DesignationController extends Controller
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
        $designations = Designation::paginate(5);

        return view('system-mgmt/designation/index', ['designations' => $designations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system-mgmt/designation/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
         designation::create([
            'name' => $request['name']
        ]);

        return redirect()->intended('system-management/designation');
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
        $designation = designation::find($id);
        // Redirect to designation list if updating designation wasn't existed
        if ($designation == null || count($designation) == 0) {
            return redirect()->intended('/system-management/designation');
        }

        return view('system-mgmt/designation/edit', ['designation' => $schemeservice]);
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
        $designation = Designation::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
        ];
        designation::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/designation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        designation::where('id', $id)->delete();
         return redirect()->intended('system-management/designation');
    }

    /**
     * Search designation from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $schemeservices = $this->doSearchingQuery($constraints);
       return view('system-mgmt/designation/index', ['schemeservices' => $schemeservices, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = designation::query();
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
        'name' => 'required|max:60|unique:schemeservice'
    ]);
    }
}
