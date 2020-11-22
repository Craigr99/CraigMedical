<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
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
        // Get all users that have a role with the name 'patient'
        // $users = Role::where('name', 'patient')->first()->users()->get();
        $patients = Patient::all();
        return view('admin.patients.index', [
            // 'users' => $users,
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
        return view('admin.patients.create');
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
            'insurance' => 'required|in:yes,no',
            'insurance_name' => 'exclude_if:insurance,no|min:2|max:40',
            'policy_num' => 'exclude_if:insurance,no|numeric|digits:13|unique:patients,policy_num',
        ];

        //custom validation error messages
        $messages = [
            'f_name.required' => 'The first name field is required.', //syntax: field_name.rule
            'l_name.required' => 'The surname field is required.', //syntax: field_name.rule
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
        $user->roles()->attach(Role::where('name', 'patient')->first());

        // Create a Patient
        $patient = new Patient();
        // $patient->insurance = $request->insurance;
        if ($request->insurance === "yes") {
            $patient->insurance = 1;
        } else if ($request->insurance === "no") {
            $patient->insurance = 0;
        }

        $patient->insurance_name = $request->insurance_name;
        $patient->policy_num = $request->policy_num;
        $patient->user_id = $user->id;
        $patient->save();

        return redirect()
            ->route('admin.patients.index')
            ->with('status', 'Created a new Patient!');
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

        return view('admin.patients.edit', [
            'patient' => $patient,
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
            'insurance_name' => 'exclude_if:insurance,no|min:2|max:40',
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
            $patient->insurance = 1;
            $patient->insurance_name = $request->input('insurance_name');
            $patient->policy_num = $request->input('policy_num');
        } else if ($request->insurance === "no") {
            $patient->insurance = 0;
            //Set insurance values to NULL
            $patient->insurance_name = null;
            $patient->policy_num = null;
        }
        $user->save();
        $patient->save();

        return redirect()->route('admin.patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $user = User::where('id', $patient->user_id);
        $patient->delete();
        $user->delete();

        return redirect()->route('admin.patients.index');
    }
}
