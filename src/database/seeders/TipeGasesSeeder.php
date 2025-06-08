<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeGasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('tipe_gases')->insert([
            [
                'name' => 'Gas O2',
                'tabung' => 6.6,  // Numeric value for tabung (with precision 8, scale 2)
                'satuan_tabung' => 'M3',  // String value for unit (satuan)
                'kgs' => 10.6,  // Numeric value for kgs
            ],
            [
                'name' => 'Gas CO2',
                'tabung' =>28,  // Numeric value for tabung
                'satuan_tabung' => 'Kgs',  // String value for unit (satuan)
                'kgs' => 28,  // Numeric value for kgs
            ],
            [
                'name' => 'Gas Acetyline',
                'tabung' => 4,  // Numeric value for tabung
                'satuan_tabung' => 'Kgs',  // String value for unit (satuan)
                'kgs' => 4,  // Numeric value for kgs
            ],
            [
                'name' => 'Gas Argon',
                'tabung' => 6,  // Numeric value for tabung
                'satuan_tabung' => 'M3',  // String value for unit (satuan)
                'kgs' => 9.64,  // Numeric value for kgs
            ],
            [
                'name' => 'Gas Liquide Argon',
                'tabung' => 150,  // Numeric value for tabung
                'satuan_tabung' => 'M3',  // String value for unit (satuan)
                'kgs' => 240.9,  // Numeric value for kgs
            ],
        ]);
    }
}
