<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PemakaianSolar;

class PemakaianSolarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PemakaianSolar::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'data' => '{}',
            'deleted_at' => fake()->dateTime(),
        ];
    }
}
