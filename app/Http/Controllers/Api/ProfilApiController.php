<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Like;
use App\Models\Dislike;
use Illuminate\Http\Request;

class ProfilApiController extends Controller
{
    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => $user,
            'profil' => $user->profil?->load('slike'),
        ]);
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $profili = Profil::with('slike')
            ->where('user_id', '!=', $userId)
            ->latest()
            ->get();

        return response()->json($profili);
    }

    public function show(Profil $profil)
    {
        return response()->json($profil->load('slike'));
    }

    public function like(Request $request, Profil $profil)
    {
        $userId = $request->user()->id;

        if ($profil->user_id === $userId) {
            return response()->json(['message' => 'Ne možeš lajkovati sebe.'], 422);
        }

        Like::firstOrCreate([
            'user_id' => $userId,
            'profil_id' => $profil->id,
        ]);

        // opcionalno: ukloni dislike ako postoji
        Dislike::where('user_id', $userId)->where('profil_id', $profil->id)->delete();

        return response()->json(['message' => 'Liked', 'profil_id' => $profil->id]);
    }

    public function dislike(Request $request, Profil $profil)
    {
        $userId = $request->user()->id;

        if ($profil->user_id === $userId) {
            return response()->json(['message' => 'Ne možeš dislajkovati sebe.'], 422);
        }

        Dislike::firstOrCreate([
            'user_id' => $userId,
            'profil_id' => $profil->id,
        ]);

        // opcionalno: ukloni like ako postoji
        Like::where('user_id', $userId)->where('profil_id', $profil->id)->delete();

        return response()->json(['message' => 'Disliked', 'profil_id' => $profil->id]);
    }
}