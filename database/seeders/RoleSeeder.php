<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        University::create([
            'id' => 346,
            'name' => 'Berdaq nomidagi Qoraqalpoq davlat universiteti',
            'logo' => 'https://hemis.karsu.uz/static/crop/2/5/250_250_90_2588838948.jpg',
            'api_key' => 'rOHCakcQnxzwSdWnoQ-dTjG-r9NGsRN9',
            'status' => '1',
        ]);
        $pos = [
            'user' => 'Gamer',
            'captain' => 'Kapitan',
            'trainer' => 'Trener',
            'organizer' => 'Organizator',
            'admin' => 'Administrator',
        ];

        $permissions = [
            ''
        ];
    }
}
