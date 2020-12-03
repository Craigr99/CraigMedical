<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'insurance' => 1,
            'policy_num' => $this->faker->numerify('#############'),
            'insurance_id' => $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
