<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Like;
use Illuminate\Http\Request;

class MatchApiController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $myProfil = $request->user()->profil;
        if (!$myProfil) {
            return response()->json(['message' => 'Nemaš profil.'], 422);
        }

        // profili koje sam ja lajkovao (id profila)
        $likedProfilIds = Like::where('user_id', $userId)->pluck('profil_id')->toArray();

        // match = ja lajkujem nekog, i taj neko je lajkovao mene (tj moj profil)
        $matchedProfilIds = Like::whereIn('user_id', Profil::whereIn('id', $likedProfilIds)->pluck('user_id'))
            ->where('profil_id', $myProfil->id)
            ->pluck('user_id')
            ->toArray();

        $matches = Profil::with('slike')
            ->whereIn('user_id', $matchedProfilIds)
            ->get();

        return response()->json($matches);
    }
}