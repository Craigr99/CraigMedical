<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:patient');
    }

    public function index()
    {
        return view('patient.home');
    }
}
