<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Visit;
use Auth;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:doctor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Vists where doctor_id = current logged in doctor
        $visits = Visit::where('doctor_id', Auth::user()->doctor->id)->get();
        return view('doctor.visits.index', [
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
        $patients = Patient::all();

        return view('doctor.visits.create', [
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
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'duration' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'patient_id' => 'required|integer',
        ]);

        $visit = new Visit();
        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->cost = $request->input('cost');
        $visit->doctor_id = Auth::user()->doctor->id;
        $visit->patient_id = $request->input('patient_id');
        $visit->save();

        $request->session()->flash('success', 'Visit created successfully!');

        return redirect()->route('doctor.visits.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visit = Visit::findOrFail($id);

        return view('doctor.visits.show', [
            'visit' => $visit,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visit = Visit::findOrFail($id);
        $patients = Patient::all();

        return view('doctor.visits.edit', [
            'visit' => $visit,
            'patients' => $patients,
        ]);
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
        $visit = Visit::findOrFail($id);
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'duration' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'patient_id' => 'required|integer',
        ]);

        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->cost = $request->input('cost');
        $visit->doctor_id = Auth::user()->doctor->id;
        $visit->patient_id = $request->input('patient_id');
        $visit->save();

        $request->session()->flash('info', 'Visit updated successfully!');

        return redirect()->route('doctor.visits.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $visit = Visit::findOrFail($id);
        $visit->delete();

        $request->session()->flash('danger', 'Visit deleted successfully!');

        return redirect()->route('doctor.visits.index');
    }
}
