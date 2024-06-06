<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->name(),
            'description'=> fake()->sentence(),
            // 5 paragrafos, true (retorna como string)
            'body'=>  fake()->paragraph(5, true),
            // 2 casas decimais, minimo 1, maximo
            'price'=> fake()->randomFloat(2, 1, 10),
            'slug'=> fake()->slug(),
        ];
    }
}
