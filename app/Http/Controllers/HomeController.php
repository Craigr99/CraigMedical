<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Currently logged in user
        $user = Auth::user();
        // Set variable to a string
        $home = 'home';

        // Conditional to check what role the user has, then set $home to a string
        if ($user->hasRole('admin')) {
            $home = 'admin.home';
        } else if ($user->hasRole('doctor')) {
            $home = 'doctor.home';
        } else if ($user->hasRole('patient')) {
            $home = 'patient.home';
        }

        // return a redirect to the appropriate home route
        return redirect()->route($home);
    }
}
