<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'whse' => 'J1',
        ]);


        //call BookSeeder
        $this->call(
            [
                BookSeeder::class,
                PostSeeder::class,
                ContactSeeder::class,
                TipeWarehousesSeeder::class,
                TipeDepartmentsSeeder::class,
                TipeGasesSeeder::class,
                TipeSectionsSeeder::class,
            ]
        );
    }
}
