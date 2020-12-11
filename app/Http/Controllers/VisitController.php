<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $index = 'visits';

        if ($user->hasRole('admin')) {
            $index = 'admin.visits.index';
        } else if ($user->hasRole('doctor')) {
            $index = 'doctor.visits.index';
        } else if ($user->hasRole('patient')) {
            $index = 'patient.visits.index';
        }

        return redirect()->route($index);
    }
}
