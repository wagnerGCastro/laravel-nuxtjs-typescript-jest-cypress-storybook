<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(5, 10),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(20),
            'status' => "A"
        ];
    }
}
