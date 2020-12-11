<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Auth;

class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:patient');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Vists where patient_id = current logged in patient
        $visits = Visit::where('patient_id', Auth::user()->patient->id)->get();
        return view('patient.visits.index', [
            'visits' => $visits,
        ]);
    }

    public function show($id)
    {
        $visit = Visit::findOrFail($id);

        return view('patient.visits.show', [
            'visit' => $visit,
        ]);
    }

    public function destroy($id)
    {
        //
    }
}
