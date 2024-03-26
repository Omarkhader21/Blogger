<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TextWidget>
 */
class TextWidgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realText(50);
        return [
            'key' => 'about-us-page',
            'image' => fake()->imageUrl(),
            'title' => $title,
            'content' => fake()->realText(5000),
            'active' => 1
        ];
    }
}
