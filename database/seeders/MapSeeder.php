<?php

namespace Database\Seeders;

use App\Models\Map;
use App\Models\Season;
use App\Models\Typing;
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

        Season::create([
            'name' => 'Rate2026',
        ]);

        Typing::create([
            'name' => 'Single Elimination 8',
            'desc' => 'Ayırım setkalardıń dawamı bolıwı ushın Single Elimination 8 qosılǵan.',
            'slug' => 'single_elimination',
            'teams' => json_encode([8]),
            'status' => '2',
        ]);
        Typing::create([
            'name' => 'Single Elimination',
            'desc' => 'Single Elimination – bul jeńilgen komanda jeńilgen ornında turnirdan shıǵıp ketiwin ańlatadı. Tek ǵana bir komanda menen oyın ótkeriw menen sheklenedi.',
            'slug' => 'single_elimination',
            'teams' => json_encode([16, 32]),
            'status' => '1',
        ]);
        Typing::create([
            'name' => 'Double Elimination',
            'desc' => 'Double Elimination – bul setkada birinshi oyınnan keyin komandalar eki Tómen hám Joqarı setkalar arqalı oyınlardı dawam ettiredi. Ulıwma esapta eki márte jeńilgen komanda sol jerdiń ózinde turnirden shıǵıp ketedi. Tómengi hám Joqarı setkada komandalar almasıp turıwı múmkin. Komandalar sanı anıq 16 bolıwı talap etiledi.',
            'slug' => 'double_elimination',
            'teams' => json_encode([16]),
            'type_id' => 1,
            'status' => '1',
        ]);
        Typing::create([
            'name' => 'Double GSL Elimination',
            'desc' => 'Double GSL Elimination – bul setkada komandalar hár biri 4 qatnasıwshıdan turatuǵıń toparlarǵa bólinedi hám birinshi oyınnan keyin komandalar eki Tómen hám Joqarı setkalar arqalı oyınlardı dawam ettiredi. Ulıwma esapta eki márte jeńilgen komanda sol jerdiń ózinde turnirden shıǵıp ketedi.',
            'slug' => 'gsl_groups',
            'teams' => json_encode([16]),
            'type_id' => 1,
            'status' => '1',
        ]);
        Typing::create([
            'name' => 'Group System',
            'desc' => 'Group System – bul setkada komandalar bir toparda óz-ara oyınlar oynaw arqalı ochko jiynap baradı, 1-2-orın iyeleri avtomatikalıq túrde 1/4 finalǵa jol aladı hám komandalar kólemine qarap (16, 24) komandalar ushın qosımsha imkaniyatlar beriliwi múmkin.',
            'slug' => 'group_system',
            'teams' => json_encode([24, 36]),
            'type_id' => 1,
            'status' => '1',
        ]);
        Typing::create([
            'name' => 'Swiss System',
            'desc' => 'Swiss System – bul setkada komandalar 3-0 kesiminde oyınlar ótkeredi. Úsh márte utqan komandalar avtomatikalıq túrde 1/4 finalǵa jol aladı. Al úsh márte jeńilgen komandalar turnirden shıǵıp ketedi.',
            'slug' => 'group_system',
            'teams' => json_encode([16, 20]),
            'type_id' => 1,
            'status' => '1',
        ]);
    }
}
