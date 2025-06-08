<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipe_sections')->insert([
            ['name' => 'Pipe Section'],
            ['name' => 'Galva Section'],
            ['name' => 'Recutting Section'],
            ['name' => 'Rollshop '],
            ['name' => 'Driver'],
            ['name' => 'Maintenance'],
        ]);
    }
}
