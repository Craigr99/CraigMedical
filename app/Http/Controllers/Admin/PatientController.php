<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
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
        $patients = Patient::paginate(10);
        return view('admin.patients.index', [
            'patients' => $patients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurance_companies = Insurance::all();

        return view('admin.patients.create', [
            'insurance_companies' => $insurance_companies,
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
        //validation rules
        $rules = [
            'f_name' => 'required|string|min:2|max:40',
            'l_name' => 'required|string|min:2|max:40',
            'address' => 'required|string|min:5|max:40',
            'phone' => 'required|numeric|min:8',
            'email' => 'required|email|min:5|max:50|unique:users,email',
            'insurance' => 'required|in:yes,no',
            'insurance_id' => 'exclude_if:insurance,no',
            'policy_num' => 'exclude_if:insurance,no|numeric|digits:13|unique:patients,policy_num',
        ];

        //custom validation error messages
        $messages = [
            'f_name.required' => 'The first name field is required.',
            'l_name.required' => 'The surname field is required.',
            'policy_num.required' => 'The policy number field is required.',
            'policy_num.digits' => 'The Policy number must be 13 characters long.',
            'policy_num.numeric' => 'The Policy number must be a number.',
        ];

        $request->validate($rules, $messages);

        //Create a User
        $user = new User();
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->postal_address = $request->address;
        $user->phone_num = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make('secret');
        $user->save();
        // Give the user a patient role
        $user->roles()->attach(Role::where('name', 'patient')->first());

        // Create a Patient
        $patient = new Patient();
        // if patient has insurance
        if ($request->insurance === "yes") {
            $patient->insurance = 1; // has health insurance = true
            $patient->insurance_id = $request->insurance_id;
            $patient->policy_num = $request->policy_num;
        } else if ($request->insurance === "no") {
            $patient->insurance = 0; // has health insurance = false
            $patient->insurance_id = null; // set insurance id to null
        }

        $patient->user_id = $user->id;
        $patient->save();

        $request->session()->flash('success', 'Patient created successfully!');

        return redirect()->route('admin.patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::findOrFail($id);

        return view('admin.patients.show', [
            'patient' => $patient,
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
        $patient = Patient::findOrFail($id);
        $insurance_companies = Insurance::all();

        return view('admin.patients.edit', [
            'patient' => $patient,
            'insurance_companies' => $insurance_companies,
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
        $user = User::findOrFail($id);
        $request->validate([
            'f_name' => 'required|string|min:2|max:40',
            'l_name' => 'required|string|min:2|max:40',
            'address' => 'required|string|min:5|max:40',
            'phone' => 'required|numeric|digits:10|',
            'email' => 'required|email|min:5|max:50|unique:users,email,' . $id,
            'insurance' => 'required|in:yes,no',
            'insurance_id' => 'exclude_if:insurance,no',
            'policy_num' => 'exclude_if:insurance,no|numeric|digits:13|unique:patients,policy_num,' . $user->patient->id,
        ]);

        $user->f_name = $request->input('f_name');
        $user->l_name = $request->input('l_name');
        $user->postal_address = $request->input('address');
        $user->phone_num = $request->input('phone');
        $user->email = $request->input('email');

        $patient = Patient::where('user_id', $id)->first();
        // IF insurance is ticked yes
        if ($request->insurance === "yes") {
            $patient->insurance = 1; // has insurance = true
            $patient->insurance_id = $request->input('insurance_id');
            $patient->policy_num = $request->input('policy_num');
        } else if ($request->insurance === "no") {
            $patient->insurance = 0; // has insurance = false
            //Set insurance values to NULL
            $patient->insurance_id = null;
            $patient->policy_num = null;
        }
        // Save user and patient objects
        $user->save();
        $patient->save();

        $request->session()->flash('info', 'Patient updated successfully!');

        return redirect()->route('admin.patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Find the user, patient and their visits
        $patient = Patient::findOrFail($id);
        $visit = Visit::where('patient_id', $patient->id);
        $user = User::where('id', $patient->user_id);

        // delete the patients visits and user
        $visit->delete();
        $patient->delete();
        $user->delete();

        $request->session()->flash('danger', 'Patient deleted successfully!');

        return redirect()->route('admin.patients.index');
    }
}
