<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class HeroFactory extends Factory
{
    public function definition(): array
    {
        // Bikin nama hero random (misal: "Alucard Smith")
        $name = fake()->unique()->firstName() . ' ' . fake()->lastName();
        
        return [
            'name' => $name,
            'slug' => Str::slug($name), // Otomatis jadi slug (alucard-smith)
            'photo' => null, // Foto dikosongin dulu
            'story' => fake()->paragraphs(3, true), // Cerita random 3 paragraf
            'user_id' => User::factory(), // Default user (nanti kita paksa pake ID Admin di Seeder)
        ];
    }
}