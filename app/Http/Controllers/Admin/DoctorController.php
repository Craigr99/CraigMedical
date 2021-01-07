<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Role;
use App\Models\User;
use App\Models\Visit;
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
        // Give the first 10 doctors
        $doctors = Doctor::paginate(10);

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
            'phone' => 'required|numeric|digits:10|',
            'email' => 'required|email|min:5|max:50|unique:users,email',
            'start_date' => 'required|date',
        ];

        //custom validation error messages
        $messages = [
            'f_name.required' => 'The first name field is required.', //syntax: field_name.rule
            'l_name.required' => 'The surname field is required.', //syntax: field_name.rule
        ];

        //First, Validate the form data
        $request->validate($rules, $messages);
        //Create a User
        $user = new User();
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

        $request->session()->flash('success', 'Doctor created successfully!');

        return redirect()->route('admin.doctors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);

        return view('admin.doctors.show', [
            'doctor' => $doctor,
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
        $doctor = Doctor::findOrFail($id);

        return view('admin.doctors.edit', [
            'doctor' => $doctor,
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
        $request->validate([
            'f_name' => 'required|string|min:2|max:40',
            'l_name' => 'required|string|min:2|max:40',
            'address' => 'required|string|min:5|max:40',
            'phone' => 'required|numeric|digits:10|',
            'email' => 'required|email|min:5|max:50|unique:users,email,' . $id,
            'start_date' => 'required|date',
        ]);

        $user = User::findOrFail($id);
        $user->f_name = $request->input('f_name');
        $user->l_name = $request->input('l_name');
        $user->postal_address = $request->input('address');
        $user->phone_num = $request->input('phone');
        $user->email = $request->input('email');

        $doctor = Doctor::where('user_id', $id)->first();
        $doctor->date_started = $request->input('start_date');
        $user->save();
        $doctor->save();

        $request->session()->flash('info', 'Doctor updated successfully!');

        return redirect()->route('admin.doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = User::where('id', $doctor->user_id);
        $visit = Visit::where('doctor_id', $doctor->id);

        $visit->delete();
        $doctor->delete();
        $user->delete();

        $request->session()->flash('danger', 'Doctor deleted successfully!');

        return redirect()->route('admin.doctors.index');
    }
}
