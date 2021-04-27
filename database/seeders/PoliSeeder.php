<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('polis')->insert([
            'poli_name' => 'THT'
        ]);

        DB::table('polis')->insert([
            'poli_name' => 'Mata'
        ]);
    }
}
