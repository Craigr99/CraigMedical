<?php

namespace Database\Seeders;

use App\Models\Insurance;
use Illuminate\Database\Seeder;

class InsuranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insurance = new Insurance();
        $insurance->name = 'VHI Healthcare';
        $insurance->save();

        $insurance = new Insurance();
        $insurance->name = 'Laya Healthcare';
        $insurance->save();

        $insurance = new Insurance();
        $insurance->name = 'Irish Life Health';
        $insurance->save();
    }
}
