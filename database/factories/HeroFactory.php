<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class HeroFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->firstName() . ' ' . fake()->lastName();
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'photo' => null,
            'story' => fake()->paragraphs(3, true),
            'user_id' => User::factory(),
        ];
    }
}