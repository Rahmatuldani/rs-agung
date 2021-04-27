<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'Administrator'
        ]);

        DB::table('roles')->insert([
            'role_name' => 'Receptionist'
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Doctor'
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Pharmacist'
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Chasier'
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Logistic'
        ]);
    }
}
