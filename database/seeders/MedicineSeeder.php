<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicine_types')->insert([
            'type_name' => 'tablet',
        ]);

        DB::table('medicine_types')->insert([
            'type_name' => 'syrup',
        ]);

        DB::table('medicines')->insert([
            'batch_id' => 'BB8433',
            'type_id' => 1,
            'medicine_name' => 'Sanmol Paracetamol',
            'medicine_stock' => 100,
            'medicine_price' => 1500,
        ]);

        DB::table('medicines')->insert([
            'batch_id' => 'AM0074',
            'type_id' => 1,
            'medicine_name' => 'Sanbe Curcuma',
            'medicine_stock' => 100,
            'medicine_price' => 2500,
        ]);

    }
}
