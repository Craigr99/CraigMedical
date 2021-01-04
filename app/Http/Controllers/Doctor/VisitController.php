<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentCancelled;
use App\Mail\AppointmentUpdated;
use App\Models\Patient;
use App\Models\User;
use App\Models\Visit;
use Auth;
use Illuminate\Http\Request;
use Mail;

class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:doctor');
    }

    public function index()
    {
        // Vists where doctor_id = current logged in doctor
        $visits = Visit::where('doctor_id', Auth::user()->doctor->id)->paginate(10);
        return view('doctor.visits.index', [
            'visits' => $visits,
        ]);
    }

    public function create()
    {
        $patients = Patient::all();

        return view('doctor.visits.create', [
            'patients' => $patients,
        ]);
    }

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

    public function show($id)
    {
        $visit = Visit::findOrFail($id);

        return view('doctor.visits.show', [
            'visit' => $visit,
        ]);
    }

    public function edit($id)
    {
        $visit = Visit::findOrFail($id);
        $patients = Patient::all();

        return view('doctor.visits.edit', [
            'visit' => $visit,
            'patients' => $patients,
        ]);
    }

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
            'patient_id' => 'required|integer',
        ]);

        $visit->date = $request->input('date');
        $visit->time = $request->input('time');
        $visit->duration = $request->input('duration');
        $visit->cost = $request->input('cost');
        $visit->doctor_id = Auth::user()->doctor->id;
        $visit->patient_id = $request->input('patient_id');
        $visit->save();

        // Send email to patient saying the visit has been changed
        Mail::to($patient->email)->send(new AppointmentUpdated($patient, $visit));

        $request->session()->flash('info', 'Visit updated successfully!');

        return redirect()->route('doctor.visits.index');
    }

    public function destroy(Request $request, $id)
    {
        $visit = Visit::findOrFail($id);
        $user = Patient::findOrFail($visit->patient_id);
        $patient = User::findOrFail($user->user_id);

        // Send email to patient passing in the patient and visit objects
        Mail::to($patient->email)->send(new AppointmentCancelled($patient, $visit));

        $visit->delete();

        $request->session()->flash('danger', 'Visit deleted successfully!');

        return redirect()->route('doctor.visits.index');
    }
}
