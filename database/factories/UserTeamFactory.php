<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTeamFactory extends Factory
{
    public function definition(): array
    {
        $kills = $this->faker->numberBetween(50, 500);
        $deaths = $this->faker->numberBetween(50, 400);
        $ratio = $deaths > 0 ? round($kills / $deaths, 2) : $kills;

        return [
            'user_id' => User::factory(),
            'team_id' => Team::factory(),
            'status' => $this->faker->randomElement(['0', '1', '2', '3']), // 1 - asosiy qabul qilingan status
            'main' => $this->faker->randomElement(['0', '1']),
            'kills' => $kills,
            'deaths' => $deaths,
            'assists' => $this->faker->numberBetween(10, 150),
            'mvps' => $this->faker->numberBetween(5, 50),
            'damages' => $this->faker->numberBetween(5000, 30000),
            'ratio' => $ratio,
            'damages_array' => json_encode([$this->faker->numberBetween(50, 150), $this->faker->numberBetween(50, 150)]),
            'ratio_array' => json_encode([1.1, 1.3, 0.9]),
        ];
    }
}
