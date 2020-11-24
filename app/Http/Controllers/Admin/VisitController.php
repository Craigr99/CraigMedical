<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visits = Visit::all();

        return view('admin.visits.index', [
            'visits' => $visits,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Role::where('name', 'doctor')->first()->users()->get();
        $patients = Role::where('name', 'patient')->first()->users()->get();

        return view('admin.visits.create',
            ['doctors' => $doctors,
                'patients' => $patients,
            ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'duration' => 'required|integer|min:0',
            'cost' => 'required|numeric|min:0',
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer',
        ]);

        $visit = new Visit();
        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->cost = $request->input('cost');
        $visit->doctor_id = $request->input('doctor_id');
        $visit->patient_id = $request->input('patient_id');
        $visit->save();

        return redirect()->route('admin.visits.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
