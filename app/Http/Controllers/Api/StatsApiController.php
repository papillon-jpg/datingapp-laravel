<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatsApiController extends Controller
{
    public function index()
    {
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

        $ageBuckets = ['18-24'=>0,'25-34'=>0,'35-44'=>0,'45+'=>0];
        foreach ($ages as $a) {
            if ($a <= 24) $ageBuckets['18-24']++;
            elseif ($a <= 34) $ageBuckets['25-34']++;
            elseif ($a <= 44) $ageBuckets['35-44']++;
            else $ageBuckets['45+']++;
        }

        $topCities = Profil::select('grad', DB::raw('COUNT(*) as total'))
            ->whereNotNull('grad')
            ->where('grad', '!=', '')
            ->groupBy('grad')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        return response()->json([
            'total_profila' => $total,
            'spol' => [
                'male' => ['count' => $maleCount, 'pct' => $malePct],
                'female' => ['count' => $femaleCount, 'pct' => $femalePct],
                'other' => ['count' => $otherCount, 'pct' => $otherPct],
            ],
            'godine' => [
                'avg' => $ages->count() ? round($ages->avg(), 1) : null,
                'min' => $ages->count() ? $ages->min() : null,
                'max' => $ages->count() ? $ages->max() : null,
                'bucket' => $ageBuckets,
            ],
            'top_gradovi' => $topCities,
        ]);
    }
}