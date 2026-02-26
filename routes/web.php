<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Profil;

use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProfilSlikaController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // DASHBOARD (statistika)
    Route::get('/dashboard', function () {

        if (!auth()->user()->profil) {
            return redirect()->route('profili.create');
        }

        $total = Profil::count();

        $maleCount = Profil::whereIn('spol', ['musko', 'Muško'])->count();
        $femaleCount = Profil::whereIn('spol', ['zensko', 'Žensko'])->count();
        $otherCount = max($total - $maleCount - $femaleCount, 0);

        $malePct = $total ? round(($maleCount / $total) * 100) : 0;
        $femalePct = $total ? round(($femaleCount / $total) * 100) : 0;
        $otherPct = $total ? round(($otherCount / $total) * 100) : 0;

        $ages = Profil::whereNotNull('datum_rodjenja')
            ->get()
            ->map(fn ($p) => Carbon::parse($p->datum_rodjenja)->age);

        $avgAge = $ages->count() ? round($ages->avg(), 1) : null;
        $minAge = $ages->count() ? $ages->min() : null;
        $maxAge = $ages->count() ? $ages->max() : null;

        $ageBuckets = [
            '18–24' => 0, '25–34' => 0, '35–44' => 0, '45+' => 0,
        ];

        foreach ($ages as $a) {
            if ($a <= 24) $ageBuckets['18–24']++;
            elseif ($a <= 34) $ageBuckets['25–34']++;
            elseif ($a <= 44) $ageBuckets['35–44']++;
            else $ageBuckets['45+']++;
        }

        $topCities = Profil::select('grad', DB::raw('COUNT(*) as total'))
            ->whereNotNull('grad')
            ->where('grad', '!=', '')
            ->groupBy('grad')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

            $topCity = $topCities->first();

        /** ✅ MARKERI ZA MAPU (Leaflet) */
$markers = Profil::whereNotNull('lat')
    ->whereNotNull('lng')
    ->select('id', 'ime', 'grad', 'lat', 'lng')
    ->limit(200)
    ->get();

return view('dashboard', compact(
    'total',
    'maleCount', 'femaleCount', 'otherCount',
    'malePct', 'femalePct', 'otherPct',
    'avgAge', 'minAge', 'maxAge',
    'ageBuckets',
    'topCities', 'topCity',
    'markers' // ✅ dodaj ovo
));
    })->name('dashboard');


    // SVE OSTALO (sve je verified + auth)
    Route::resource('profili', ProfilController::class)
        ->parameters(['profili' => 'profil']);

    Route::get('/browse', [BrowseController::class, 'index'])->name('browse.index');
    Route::post('/browse/{profil}/like', [BrowseController::class, 'like'])->name('browse.like');
    Route::post('/browse/{profil}/dislike', [BrowseController::class, 'dislike'])->name('browse.dislike');

    Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
    Route::delete('/likes/{profil}', [MatchController::class, 'undoLike'])->name('likes.undo');
    Route::delete('/dislikes/{profil}', [MatchController::class, 'undoDislike'])->name('dislikes.undo');

    Route::get('/chat/{profil}', function (Profil $profil) {
        return view('chat.index', compact('profil'));
    })->name('chat.index');

    // brisanje jedne slike iz galerije
    Route::delete('/profil-slike/{slika}', [ProfilSlikaController::class, 'destroy'])
        ->name('profil-slike.destroy');

    // moj profil shortcut
    Route::get('/moj-profil', function () {
        $profil = auth()->user()->profil;

        if (!$profil) {
            return redirect()->route('profili.create');
        }

        return redirect()->route('profili.show', $profil);
    })->name('mojprofil');

});