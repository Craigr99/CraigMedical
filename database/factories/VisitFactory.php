<?php

namespace Database\Factories;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doctors = Doctor::all();
        $patients = Patient::all();

        $date = $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now');
        $dateFormat = $date->format('Y-m-d');

        return [
            'doctor_id' => $this->faker->numberBetween($min = 1, $max = count($doctors)),
            'patient_id' => $this->faker->numberBetween($min = 1, $max = count($patients)),
            'date' => $dateFormat,
            'time' => date('H:i:s', rand(1, 54000)), // 00:00:00 - 15:00:00
            'duration' => $this->faker->numberBetween($min = 5, $max = 60),
            'cost' => $this->faker->numberBetween($min = 10, $max = 100),
        ];
    }
}
