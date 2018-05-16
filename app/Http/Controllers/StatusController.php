<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Status;

class StatusController extends Controller
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
        $statuss = Status::paginate(5);

        return view('system-mgmt/status/index', ['statuss' => $statuss]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
             $statuss = Status::all();
        return view('system-mgmt/status/create', ['statuss' => $statuss]);
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
         status::create([
            'name' => $request['name']
        ]);

        return redirect()->intended('system-management/status');
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
        $status = status::find($id);
        // Redirect to status list if updating status wasn't existed
        if ($status == null || count($status) == 0) {
            return redirect()->intended('/system-management/status');
        }

        return view('system-mgmt/status/edit', ['status' => $status]);
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
        $status = Status::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
        ];
        status::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        status::where('id', $id)->delete();
         return redirect()->intended('system-management/status');
    }

    /**
     * Search schemeservice from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $schemeservices = $this->doSearchingQuery($constraints);
       return view('system-mgmt/status/index', ['status' => $status, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = status::query();
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
        'name' => 'required|max:60|unique:status'
    ]);
    }
}
