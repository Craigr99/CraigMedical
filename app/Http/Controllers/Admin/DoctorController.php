<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
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
        // Get all users that have a role with the name 'doctor'
        $doctors = Role::where('name', 'doctor')->first()->users()->get();

        return view('admin.doctors.index', [
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

        return view('admin.doctors.create');
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
            'address' => 'required|string|min:5|max:40',
            'phone' => 'required|numeric|min:8',
            'email' => 'required|email|min:5|max:50|unique:users,email',
            'start_date' => 'required|date',
        ];

        //custom validation error messages
        $messages = [
            'f_name.required' => 'The first name field is required.', //syntax: field_name.rule
            'l_name.required' => 'The surname field is required.', //syntax: field_name.rule
        ];

        //First Validate the form data
        $request->validate($rules, $messages);
        //Create a Doctor
        $user = new User;
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->postal_address = $request->address;
        $user->phone_num = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make('secret');
        $user->save(); // save it to the database.
        // attatch the user role of doctor
        $user->roles()->attach(Role::where('name', 'doctor')->first());

        $doctor = new Doctor();
        $doctor->date_started = $request->start_date;
        $doctor->user_id = $user->id;
        $doctor->save();

        return redirect()
            ->route('admin.doctors.index')
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
        $user = User::findOrFail($id);

        return view('admin.doctors.show', [
            'user' => $user,
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
        $user = User::findOrFail($id);
        $doctor = Doctor::where('user_id', $id);
        $doctor->delete();
        $user->delete();

        return redirect()->route('admin.doctors.index');
    }
}
