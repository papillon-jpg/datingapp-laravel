<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Profil;
use App\Models\ProfilSlika;
use App\Models\Like;
use App\Models\Dislike;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Kreiraj 10 usera
        $users = User::factory()->count(10)->create();

        // 2) Kreiraj profil + profilna slika + 3 slike u galeriji
        $users->each(function ($user) {
            $main = 'profili/demo' . rand(1, 5) . '.jpg';

            $profil = Profil::factory()->create([
                'user_id' => $user->id,
                'profilna_slika' => $main,
            ]);

            // (opcionalno) ubaci i glavnu sliku u galeriju kao prvu
            ProfilSlika::create([
                'profil_id' => $profil->id,
                'path' => $main,
            ]);

            // još 2 slike (ukupno 3 u galeriji)
            for ($i = 0; $i < 2; $i++) {
                ProfilSlika::create([
                    'profil_id' => $profil->id,
                    'path' => 'profili/demo' . rand(1, 5) . '.jpg',
                ]);
            }
        });

        // 3) Pripremi mape: user_id -> profil_id (da ne radimo find() u petlji)
        $profiles = Profil::select('id', 'user_id')->get();

        $userToProfil = $profiles->pluck('id', 'user_id'); // [user_id => profil_id]
        $profilIds = $profiles->pluck('id')->values();     // [profil_id, profil_id, ...]

        // helper: uzmi target profil koji nije od tog usera
        $pickTargetProfil = function (int $userId) use ($profilIds, $userToProfil) {
            $myProfilId = $userToProfil[$userId] ?? null;

            return $profilIds
                ->reject(fn ($pid) => $pid === $myProfilId)
                ->random();
        };

        // 4) Random lajkovi (bez dupliranja)
        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $targetProfilId = $pickTargetProfil($user->id);

            Like::firstOrCreate([
                'user_id' => $user->id,
                'profil_id' => $targetProfilId,
            ]);
        }

        // 5) Random dislajkovi (bez dupliranja)
        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $targetProfilId = $pickTargetProfil($user->id);

            Dislike::firstOrCreate([
                'user_id' => $user->id,
                'profil_id' => $targetProfilId,
            ]);
        }
    }
}