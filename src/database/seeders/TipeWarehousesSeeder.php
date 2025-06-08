<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeWarehousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipe_warehouses')->insert([
            ['name' => 'J1', 'description' => 'J1 - Jakarta 1'],
            ['name' => 'J2', 'description' => 'J2 - Jakarta 2'],
            ['name' => 'C1', 'description' => 'C1 - Cikarang'],
            ['name' => 'S1', 'description' => 'S1 - Semarang'],
        ]);
    }
}
