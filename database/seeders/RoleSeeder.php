<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name'=> 'Admin', 'description'=>'Role Admin'],
            ['name'=> 'Coordinator', 'description'=>'Role Coordinator'],
            ['name'=> 'Student', 'description'=>'Role Student'],
        ]);
    }
}
