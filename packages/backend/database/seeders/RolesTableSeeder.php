<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = [
            ['id' => 1, 'name' => 'Stephan de Vries', 'username' => 'stephan', 'email' => 'stephan-v@gmail.com', 'password' => bcrypt('carrotz124')],
            ['id' => 2, 'name' => 'John doe', 'username' => 'johnny', 'email' => 'johndoe@gmail.com', 'password' => bcrypt('carrotz1243')],
        ];

        \App\Models\Role::create($roles);
    }
}
