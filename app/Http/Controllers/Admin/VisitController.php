<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentCancelled;
use App\Mail\AppointmentUpdated;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Mail;

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
        $visits = Visit::paginate(10);

        return view('admin.visits.index', [
            'visits' => $visits,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();

        return view('admin.visits.create', [
            // pass in the id of the doctor or patient if the user wants to create a new visit for a particular doctor / patient
            'id' => $id,
            'doctors' => $doctors,
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

        $request->session()->flash('success', 'Visit created successfully!');

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
        $visit = Visit::findOrFail($id);

        return view('admin.visits.show', [
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
        // Get the visit and related doctor and patient
        $visit = Visit::findOrFail($id);
        $doctors = Doctor::all();
        $patients = Patient::all();

        return view('admin.visits.edit', [
            'visit' => $visit,
            'doctors' => $doctors,
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
        $user = Patient::findOrFail($visit->patient_id);
        $patient = User::findOrFail($user->user_id);

        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'duration' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'doctor_id' => 'required|integer',
            'patient_id' => 'required|integer',
        ]);

        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->cost = $request->input('cost');
        $visit->doctor_id = $request->input('doctor_id');
        $visit->patient_id = $request->input('patient_id');
        $visit->save();

        // Send email to patient saying the visit has been changed, ONLY if the status is active
        if ($visit->status === "Active") {
            Mail::to($patient->email)->send(new AppointmentUpdated($patient, $visit));
        }

        $request->session()->flash('info', 'Visit updated successfully!');

        return redirect()->route('admin.visits.index');
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
        $user = Patient::findOrFail($visit->patient_id);
        $patient = User::findOrFail($user->user_id);

        // Send email to patient passing in the patient and visit objects if the status is still active
        if ($visit->status === "Active") {
            Mail::to($patient->email)->send(new AppointmentCancelled($patient, $visit));
        }

        $visit->delete();

        $request->session()->flash('danger', 'Visit deleted successfully!');

        return redirect()->route('admin.visits.index');
    }
}
