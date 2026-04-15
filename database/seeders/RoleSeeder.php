<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Season;
use App\Models\Team;
use App\Models\Typing;
use App\Models\University;
use App\Models\User;
use App\Models\UserTeam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Option::create([
            'key' => 'transfer',
            'section' => 'text',
            'value' => '0',
        ]);
        /*University::create([
            'id' => 1,
            'name' => 'Ulıwma qatnasıwshı',
            'logo' => '****',
            'api_key' => '***',
            'status' => '1',
        ]);

        for ($i = 0; $i < 10; $i++) {
            $players = User::factory(5)->create();
            $team = Team::factory()->create([
                'creator_id' => $players[0]->id,
                'captain_id' => $players[0]->id,
                'status' => 'active',
            ]);
            foreach ($players as $index => $player) {
                UserTeam::factory()->create([
                    'user_id' => $player->id,
                    'team_id' => $team->id,
                    'status' => '1',
                    'main' => '1',
                ]);
            }
        }

        /*University::create([
            'id' => 346,
            'name' => 'Berdaq atındaǵı Qaraqalpaq mámleketlik universiteti',
            'logo' => 'https://hemis.karsu.uz/static/crop/2/5/250_250_90_2588838948.jpg',
            'api_key' => 'rOHCakcQnxzwSdWnoQ-dTjG-r9NGsRN9',
            'status' => '1',
        ]);
        $pos = [
            'user' => 'Gamer',
            'trainer' => 'Trener',
            'organizer' => 'Organizator',
            'admin' => 'Administrator',
            'super' => 'Superadmin',
        ];

        $permissions = [
            ''
        ];*/

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

        $uni_id = DB::table('universities')->insertGetId([
            'name' => 'CS2 DevCUP University',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        $season_id = 1;

        $tournament1_id = DB::table('tournaments')->insertGetId([
            'name' => 'DevCUP Major 2026',
            'desc' => 'Blast Pro Series Tashkent',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        $tournament2_id = DB::table('tournaments')->insertGetId([
            'name' => 'Blast Pro Series Tashkent',
            'desc' => 'Blast Pro Series Tashkent',
            'created_at' => now(), 'updated_at' => now(),
        ]);

        // CS2 Xaritalarini qo'shish
        $mapNames = [
            'de_inferno' => 'Inferno',
            'de_mirage' => 'Mirage',
            'de_dust2' => 'Dust II',
            'de_anubis' => 'Anubis',
            'de_ancient' => 'Ancient',
            'de_overpass' => 'Overpass',
            'de_nuke' => 'Nuke',
        ];
        $mapIds = [];
        foreach ($mapNames as $slug => $map) {
            $mapIds[] = DB::table('maps')->insertGetId([
                'name' => $map,
                'slug' => $slug,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Turnirlarga xaritalarni biriktirish (tournament_maps)
        foreach ([$tournament1_id, $tournament2_id] as $t_id) {
            foreach ($mapIds as $m_id) {
                DB::table('tournament_maps')->insert(['tournament_id' => $t_id, 'map_id' => $m_id]);
            }
        }

        // 2. 30 TA JAMOA VA 150 TA O'YINCHI YARATISH
        $allTeams = [];
        for ($i = 0; $i < 30; $i++) {
            $players = User::factory(5)->create(); // Har bir jamoada 5 ta o'yinchi

            $team = Team::factory()->create([
                'creator_id' => $players[0]->id,
                'captain_id' => $players[0]->id,
                'form_id' => $uni_id,
                'status' => 'active',
            ]);
            $allTeams[] = $team;

            // O'yinchilarni jamoaga, sezonga va turnirga qo'shish
            foreach ($players as $player) {
                UserTeam::factory()->create([
                    'user_id' => $player->id, 'team_id' => $team->id, 'status' => '1', 'main' => '1',
                ]);

                // user_tournaments (Faqat 1-turnirga qatnashyapti deb faraz qilamiz)
                DB::table('user_tournaments')->insert([
                    'tournament_id' => $tournament1_id, 'team_id' => $team->id, 'user_id' => $player->id,
                    'kills' => rand(10, 50), 'deaths' => rand(10, 50), 'assists' => rand(2, 15), 'mvps' => rand(0, 5), 'damages' => rand(1000, 5000),
                ]);
            }

            // season_teams va tournament_teams ga jamoani qo'shish
            DB::table('season_teams')->insert(['season_id' => $season_id, 'team_id' => $team->id]);
            DB::table('tournament_teams')->insert(['tournament_id' => $tournament1_id, 'team_id' => $team->id, 'status' => '1']);
            if ($i % 2 == 0) { // Har ikkinchi jamoani 2-turnirga ham qo'shamiz
                DB::table('tournament_teams')->insert(['tournament_id' => $tournament2_id, 'team_id' => $team->id, 'status' => '1']);
            }
        }

        // 3. O'YINLAR (GAMES) VA NATIJALAR (SCORES, ROUNDS, USER_GAMES) YARATISH
        // 30 ta jamoani aralashtirib 15 ta o'yin qilamiz
        for ($i = 0; $i < 15; $i++) {
            $team1 = $allTeams[$i];
            $team2 = $allTeams[29 - $i]; // Oxiridan boshlab olamiz

            // O'yin yaratish
            $game_id = DB::table('games')->insertGetId([
                'tournament_id' => $tournament1_id,
                'team_1_id' => $team1->id,
                'team_2_id' => $team2->id,
                'stage' => 'Group Stage',
                'status' => 'finished',
                'format' => 'BO1',
                'win' => rand(0, 1) ? 't1' : 't2',
                'created_at' => now(), 'updated_at' => now(),
            ]);

            $map_id = $mapIds[array_rand($mapIds)];
            $t1_score = rand(8, 13);
            $t2_score = $t1_score == 13 ? rand(0, 11) : 13;
            $winner_team_id = $t1_score > $t2_score ? $team1->id : $team2->id;

            // Xarita natijasi (Score)
            $score_id = DB::table('scores')->insertGetId([
                'name' => 'Map 1', 'map_number' => 1, 'game_id' => $game_id, 'map_id' => $map_id,
                'pick_id' => rand(0, 1) ? $team1->id : $team2->id,
                'team_1_score' => $t1_score, 'team_2_score' => $t2_score,
                'win' => $t1_score > $t2_score ? 't1' : 't2',
                'winner_team_id' => $winner_team_id,
                'created_at' => now(), 'updated_at' => now(),
            ]);

            // Raundlar yaratish
            $total_rounds = $t1_score + $t2_score;
            for ($r = 1; $r <= $total_rounds; $r++) {
                DB::table('rounds')->insert([
                    'round_number' => $r, 'score_id' => $score_id,
                    'winner_team_id' => rand(0, 1) ? $team1->id : $team2->id,
                    'win_type' => collect(['bomb_defused', 'elimination', 'bomb_exploded', 'time_expired'])->random(),
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }

            // O'yinchi statistikalari (user_games) - Ikkala jamoaning 10 ta o'yinchisi uchun
            $team1_users = DB::table('user_teams')->where('team_id', $team1->id)->pluck('user_id');
            $team2_users = DB::table('user_teams')->where('team_id', $team2->id)->pluck('user_id');

            foreach (array_merge($team1_users->toArray(), $team2_users->toArray()) as $userId) {
                $kills = rand(5, 30);
                $deaths = rand(5, 25);

                DB::table('user_games')->insert([
                    'user_id' => $userId,
                    'team_id' => in_array($userId, $team1_users->toArray()) ? $team1->id : $team2->id,
                    'score_id' => $score_id,
                    'map_id' => $map_id,
                    'kills' => $kills,
                    'deaths' => $deaths,
                    'assists' => rand(1, 10),
                    'mvps' => rand(0, 5),
                    'damages' => rand(800, 3500),
                    'ratio' => $deaths > 0 ? round($kills / $deaths, 2) : $kills,
                    'win' => in_array($userId, $team1_users->toArray()) ? ($t1_score > $t2_score ? '1' : '0') : ($t2_score > $t1_score ? '1' : '0'),
                    'created_at' => now(), 'updated_at' => now(),
                ]);
            }
        }
    }
}
