<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PemakaianGas;

class PemakaianGasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PemakaianGas::class;

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
