<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'administrator',
            'name' => 'administrator',
            'password' => Hash::make('adminpass'),
            'role_id' => 1,
            'is_actived' => 1,
        ]);

        DB::table('users')->insert([
            'username' => 'receptionist',
            'name' => 'receptionist',
            'password' => Hash::make('adminpass'),
            'role_id' => 2,
            'is_actived' => 1,
        ]);

        DB::table('users')->insert([
            'username' => 'doctor',
            'name' => 'doctor',
            'password' => Hash::make('adminpass'),
            'role_id' => 3,
            'is_actived' => 1,
        ]);

        DB::table('users')->insert([
            'username' => 'pharmacist',
            'name' => 'pharmacist',
            'password' => Hash::make('adminpass'),
            'role_id' => 4,
            'is_actived' => 1,
        ]);

        DB::table('users')->insert([
            'username' => 'chasier',
            'name' => 'chasier',
            'password' => Hash::make('adminpass'),
            'role_id' => 5,
            'is_actived' => 1,
            ]);

        DB::table('users')->insert([
            'username' => 'logistic',
            'name' => 'logistic',
            'password' => Hash::make('adminpass'),
            'role_id' => 6,
            'is_actived' => 1,
        ]);

        DB::table('patients')->insert([
            'patient_name' => 'Rahmatul Ramadhani',
            'patient_sex' => 'l',
            'patient_birth' => '1999-12-16',
            'paid_status' => 'tunai',
            'patient_job' => 'Mahasiswa',
            'patient_partner' => 'Belum ada',
            'patient_address' => 'Gang Delima Yogyakarta',
            'blood_type' => 'b',
            'patient_phone' => '08990929826',
            'religion' => 'Islam',
        ]);
    }
}
