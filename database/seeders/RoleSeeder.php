<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\University;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Option::create([
            'key' => 'transfer',
            'section' => 'text',
            'value' => '0',
        ]);
        University::create([
            'id' => 1,
            'name' => 'Ulıwma qatnasıwshı',
            'logo' => '****',
            'api_key' => '***',
            'status' => '1',
        ]);
        /*University::create([
            'id' => 346,
            'name' => 'Berdaq atındaǵı Qaraqalpaq mámleketlik universiteti',
            'logo' => 'https://hemis.karsu.uz/static/crop/2/5/250_250_90_2588838948.jpg',
            'api_key' => 'rOHCakcQnxzwSdWnoQ-dTjG-r9NGsRN9',
            'status' => '1',
        ]);*/
        $pos = [
            'user' => 'Gamer',
            'trainer' => 'Trener',
            'organizer' => 'Organizator',
            'admin' => 'Administrator',
            'super' => 'Superadmin',
        ];

        $permissions = [
            ''
        ];
    }
}
