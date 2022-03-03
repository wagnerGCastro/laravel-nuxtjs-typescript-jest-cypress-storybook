<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /** parent menu  */
        // return [
        //     'id_top_menu' => null,
        //     'name' => 'Usuarios',
        //     'description' => 'Usuários',
        //     'status' => 'A'
        // ];

        /** child menu */
        return [
            'id_top_menu' => 1,
            'name' => 'ListarUsuarios',
            'description' => 'Listar Usuários',
            'status' => 'A'
        ];
    }
}
