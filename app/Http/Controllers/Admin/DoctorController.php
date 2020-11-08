<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function home()
    {
        return view('admin.home');
    }

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
        $doctor = User::findOrFail($id);
        $doctor->delete();

        return redirect()->route('admin.doctors.index');
    }
}
