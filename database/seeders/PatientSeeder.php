<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Role;
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
        $role_patient = Role::where('name', 'patient')->first();

        foreach ($role_patient->users as $user) {
            $patient = new Patient();
            $patient->insurance = true;
            $patient->insurance_id = 1;
            $patient->policy_num = $this->random_str(12, '0123456789');
            $patient->user_id = $user->id;
            $patient->save();
        }
    }

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
