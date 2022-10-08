<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'room_name' => 'Anyelir 1',
            'room_status' => 'Kosong',
            'room_class' => '1',
            'room_capacity' => '2',
            'room_price' => 12000
        ]);
        DB::table('rooms')->insert([
            'room_name' => 'Anyelir 2',
            'room_status' => 'Kosong',
            'room_class' => '2',
            'room_capacity' => '3',
            'room_price' => 12000
        ]);
        DB::table('rooms')->insert([
            'room_name' => 'Anyelir 3',
            'room_status' => 'Kosong',
            'room_class' => '3',
            'room_capacity' => '4',
            'room_price' => 12000
        ]);
        DB::table('rooms')->insert([
            'room_name' => 'Anyelir 4',
            'room_status' => 'Kosong',
            'room_class' => '4',
            'room_capacity' => '5',
            'room_price' => 12000
        ]);
    }
}
