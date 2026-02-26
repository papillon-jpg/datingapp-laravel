<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Dislike;
use App\Models\Profil;

class MatchController extends Controller
{
    public function index()
    {
        $myUserId = auth()->id();
        $myProfil = auth()->user()->profil;

        // 1) Profili koje sam JA lajkao (profil_id su profili drugih)
        $likedProfils = Profil::whereIn(
            'id',
            Like::where('user_id', $myUserId)->pluck('profil_id')
        )->latest()->get();

        // 2) Profili koje sam JA dislajkao
        $dislikedProfils = Profil::whereIn(
            'id',
            Dislike::where('user_id', $myUserId)->pluck('profil_id')
        )->latest()->get();

        // 3) MATCH = ja lajkam njih, i ONI lajkuju MENE
        // oni mene lajkuju tako što u likes tabeli imaju profil_id = moj_profil_id
        $matches = collect();

        if ($myProfil) {
            $matches = Profil::whereIn(
                'id',
                Like::where('user_id', $myUserId)->pluck('profil_id') // ja njih lajkam
            )->whereIn(
                'user_id',
                Like::where('profil_id', $myProfil->id)->pluck('user_id') // oni mene lajkuju
            )->latest()->get();
        }

        return view('matches.index', compact('likedProfils', 'dislikedProfils', 'matches'));
    }

        public function undoLike($profilId)
    {
        Like::where('user_id', auth()->id())
            ->where('profil_id', $profilId)
            ->delete();

        return redirect()->back()->with('status', 'Lajk je vraćen (undo).');
    }

    public function undoDislike($profilId)
    {
        Dislike::where('user_id', auth()->id())
            ->where('profil_id', $profilId)
            ->delete();

        return redirect()->back()->with('status', 'Dislajk je vraćen (undo).');
    }
}