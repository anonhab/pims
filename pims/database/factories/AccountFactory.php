<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Prison;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()

    {
        
        return [
           'user_id' => fake()->numberBetween(1000000, 9999999),

            'username'     => $this->faker->userName,
            'password'     => 'password123', // Plain because the model doesn't rehash
            'role_id'      => 2, // You can change to match a valid role_id from your seeder
           'prison_id' => Prison::factory(),
            'first_name'   => $this->faker->firstName,
            'last_name'    => $this->faker->lastName,
            'email'        => $this->faker->unique()->safeEmail,
            'user_image'   => 'default.jpg',
            'phone_number' => $this->faker->phoneNumber,
            'dob'          => $this->faker->date(),
            'gender'       => $this->faker->randomElement(['Male', 'Female']),
            'address'      => $this->faker->address,
        ];
    }
}
