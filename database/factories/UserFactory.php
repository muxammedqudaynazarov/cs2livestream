<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $steamId = $this->faker->unique()->numerify('7656119########');
        $username = $this->faker->unique()->userName();
        $avatarUrl = 'https://api.dicebear.com/8.x/adventurer/svg?seed=' . urlencode($username);
        return [
            'id' => $steamId,
            'name' => $username,
            'real_name' => $this->faker->name(),
            'profile_url' => 'https://steamcommunity.com/profiles/' . $steamId,
            'steam_avatar' => $avatarUrl,
            'user_photo' => $avatarUrl,
            'country' => $this->faker->randomElement(['UZ', 'KZ', 'KG', 'RU']),
            'pos' => $this->faker->randomElement(['user', 'admin', 'moderator']),
            'faceit' => json_encode([
                'level' => $this->faker->numberBetween(1, 10),
                'elo' => $this->faker->numberBetween(500, 3500)
            ]),
            'elo' => $this->faker->numberBetween(500, 3000),
            'priority' => $this->faker->randomElement(['1', '0']),
            'remember_token' => Str::random(10),
        ];
    }
}
