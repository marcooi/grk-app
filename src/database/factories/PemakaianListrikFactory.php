<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PemakaianListrik;

class PemakaianListrikFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PemakaianListrik::class;

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
