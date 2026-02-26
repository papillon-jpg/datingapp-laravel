<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\Like;
use App\Models\Dislike;
use Illuminate\Support\Facades\Auth;

class BrowseController extends Controller
{

    public function index()
{
    $userId = auth()->id();

    $likedIds = Like::where('user_id', $userId)->pluck('profil_id');
    $dislikedIds = Dislike::where('user_id', $userId)->pluck('profil_id');

    $profil = Profil::where('user_id', '!=', $userId)
        ->whereNotIn('id', $likedIds)
        ->whereNotIn('id', $dislikedIds)
        ->latest()
        ->first();

    return view('browse.index', compact('profil'));
}

   public function like($id)
{
    Like::create([
        'user_id' => auth()->id(),
        'profil_id' => $id
    ]);

    return redirect()->route('browse.index');
}

public function dislike($id)
{
    Dislike::create([
        'user_id' => auth()->id(),
        'profil_id' => $id
    ]);

    return redirect()->route('browse.index');
}

}