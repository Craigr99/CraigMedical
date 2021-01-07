<?php

namespace Database\Seeders;

use App\Models\Visit;
use Illuminate\Database\Seeder;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a number of visits using visit factory
        for ($i = 1; $i <= 8; $i++) {
            $visit = Visit::factory()->create();
        }
    }
}
