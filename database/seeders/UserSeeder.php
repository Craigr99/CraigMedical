<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get roles
        $role_admin = Role::where('name', 'admin')->first();
        $role_doctor = Role::where('name', 'doctor')->first();
        $role_patient = Role::where('name', 'patient')->first();

        // Admin user
        $admin = new User();
        $admin->f_name = 'Admin fname';
        $admin->l_name = 'Admin lname';
        $admin->email = 'admin@example.com';
        $admin->postal_address = '123456';
        $admin->phone_num = '0852785998';
        $admin->password = Hash::make('secret');
        $admin->save();
        $admin->roles()->attach($role_admin);

        // Doctor users
        $doctor = new User();
        $doctor->f_name = 'Doctor';
        $doctor->l_name = 'Nick';
        $doctor->email = 'doctor@example.com';
        $doctor->postal_address = '123456';
        $doctor->phone_num = '0852785998';
        $doctor->password = Hash::make('secret');
        $doctor->start_date = '2020-11-03';
        $doctor->save();
        $doctor->roles()->attach($role_doctor);

        $doctor = new User();
        $doctor->f_name = 'Doctor';
        $doctor->l_name = 'John';
        $doctor->email = 'doctorjohn@example.com';
        $doctor->postal_address = '123456';
        $doctor->phone_num = '085234546';
        $doctor->password = Hash::make('secret');
        $doctor->start_date = '2019-11-01';
        $doctor->save();
        $doctor->roles()->attach($role_doctor);

        // Patient user
        $patient = new User();
        $patient->f_name = 'Patient';
        $patient->l_name = 'User';
        $patient->email = 'patient@example.com';
        $patient->postal_address = '123456';
        $patient->phone_num = '0852785998';
        $patient->password = Hash::make('secret');
        $patient->save();
        $patient->roles()->attach($role_patient);
    }
}
