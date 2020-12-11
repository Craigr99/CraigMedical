<?php

namespace Database\Factories;

use App\Models\User;
use Hash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'f_name' => $this->faker->firstName,
            'l_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'postal_address' => $this->faker->address,
            'phone_num' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'remember_token' => Str::random(10),
        ];
    }
}
