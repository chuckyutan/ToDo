<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "status" => $this->faker->numberBetween($min = 1, $max = 3),
            "name" => $this->faker->text(),
            "user_id" => User::inRandomOrder()->first()->id,
        ];
    }
}
