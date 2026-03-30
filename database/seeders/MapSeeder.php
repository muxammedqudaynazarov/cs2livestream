<?php

namespace Database\Seeders;

use App\Models\Map;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    public function run(): void
    {
        $maps = [
            'de_inferno' => 'Inferno',
            'de_mirage' => 'Mirage',
            'de_dust2' => 'Dust II',
            'de_anubis' => 'Anubis',
            'de_ancient' => 'Ancient',
            'de_overpass' => 'Overpass',
            'de_nuke' => 'Nuke',
        ];
        foreach ($maps as $slug => $name) {
            Map::create([
                'name' => $name,
                'slug' => $slug,
            ]);
        }
    }
}
