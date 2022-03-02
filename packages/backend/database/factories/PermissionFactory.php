<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionResouceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'resource_id' => 1,
            'name' => 'menu_user',
            'description' => 'Visualizar menu principal usuários',
            'status' => 'A'
        ];
    }
}
