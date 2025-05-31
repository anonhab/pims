<?php

namespace Database\Factories;

use App\Models\Prison;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrisonFactory extends Factory
{
    protected $model = Prison::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'location' => $this->faker->address,
            // add other fields your prisons table requires
        ];
    }
}
