<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Academic;

class AcademicController extends Controller
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
        $academics = Academic::paginate(5);

        return view('trn1-mgmt/academic/index', ['academics' => $academics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trn1-mgmt/academic/create');
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
         Academic::create([
            'name' => $request['name']
        ]);

        return redirect()->intended('trn1-management/academic');
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
        $academic = Academic::find($id);
        // Redirect to academic list if updating academic wasn't existed
        if ($academic == null || count($academic) == 0) {
            return redirect()->intended('/trn1-management/academic');
        }

        return view('trn1-mgmt/academic/edit', ['academic' => $academic]);
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
        $academic = academic::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
        ];
        academic::where('id', $id)
            ->update($input);
        
        return redirect()->intended('trn1-management/academic');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        academic::where('id', $id)->delete();
         return redirect()->intended('trn1-management/academic');
    }

    /**
     * Search academic from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $academics = $this->doSearchingQuery($constraints);
       return view('trn1-mgmt/academic/index', ['academics' => $academics, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = academic::query();
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
        'name' => 'required|max:60|unique:academic'
    ]);
    }
}
