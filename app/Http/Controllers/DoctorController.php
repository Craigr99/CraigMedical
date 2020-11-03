<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

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
        // Get users that belong to the role named 'doctor'
        $doctors = Role::where('name', 'doctor')->first()->users()->get();

        return view('doctors.index', [
            'doctors' => $doctors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('doctors.create');
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

        //validation rules
        $rules = [
            'f_name' => 'required|string|min:2|max:40',
            'l_name' => 'required|string|min:2|max:40',
        ];

        //First Validate the form data
        $request->validate($rules);
        //Create a Doctor
        $doctor = new User;
        $doctor->f_name = $request->f_name;
        $doctor->l_name = $request->l_name;
        $doctor->postal_address = $request->address;
        $doctor->phone_num = $request->phone;
        $doctor->email = $request->email;
        $doctor->start_date = $request->start_date;
        $doctor->save(); // save it to the database.
        // attatch the user role of doctor
        $doctor->roles()->attach(Role::where('name', 'doctor')->first());

        return redirect()
            ->route('doctors.index')
            ->with('status', 'Created a new Doctor!');
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
