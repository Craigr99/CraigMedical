<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get the doctor role
        $role_doctor = Role::where('name', 'doctor')->first();
        // find user with id 2
        $user = User::findOrFail(2);
        $doctor = new Doctor();
        $doctor->date_started = '2020-01-20';
        $doctor->user_id = $user->id; // set doctor->user id to $user id
        $doctor->save();

        // foreach ($role_doctor->users as $user) {
        //     $doctor = new Doctor();
        //     $doctor->date_started = '2020-01-20';
        //     $doctor->user_id = $user->id;
        //     $doctor->save();
        // }
    }
}
