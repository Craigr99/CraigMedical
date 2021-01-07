<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get a date from 5 years ago to now
        $date = $this->faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now');
        // format the date DD/MM/YYYY
        $dateFormat = $date->format('Y-m-d');

        return [
            'date_started' => $dateFormat,
        ];
    }
}
