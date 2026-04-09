<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company() . ' Esports',
            'tag' => strtoupper($this->faker->unique()->lexify('???')),
            'logo' => 'https://api.dicebear.com/8.x/bottts/svg?seed=' . Str::random(8) . '&backgroundColor=1e293b',
            'cristal' => $this->faker->numberBetween(500, 5000),
            'creator_id' => User::factory(),
            'captain_id' => function (array $attributes) {
                return $attributes['creator_id']; // Kapitan va yaratuvchi bitta odam
            },
            'form_id' => 1,
            'join_url' => Str::random(12),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
