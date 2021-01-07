<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get patient role
        $role_patient = Role::where('name', 'patient')->first();
        $user = User::findOrFail(4);
        $patient = new Patient();
        $patient->insurance = true;
        $patient->insurance_id = 1; //VHI
        $patient->policy_num = $this->random_str(12, '0123456789'); // Random 12 string from 0-9
        $patient->user_id = $user->id; // set patient->user_id to $user id
        $patient->save();

        // foreach ($role_patient->users as $user) {
        //     $patient = new Patient();
        //     $patient->insurance = true;
        //     $patient->insurance_id = 1;
        //     $patient->policy_num = $this->random_str(12, '0123456789');
        //     $patient->user_id = $user->id;
        //     $patient->save();
        // }
    }

    // Function to generate a random string
    private function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces[] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
