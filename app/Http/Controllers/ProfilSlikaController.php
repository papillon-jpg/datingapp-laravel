<?php

namespace App\Http\Controllers;

use App\Models\ProfilSlika;
use Illuminate\Support\Facades\Storage;

class ProfilSlikaController extends Controller
{
    public function destroy(ProfilSlika $profilSlika)
    {
        abort_unless(auth()->id() === $profilSlika->profil->user_id, 403);

        Storage::disk('public')->delete($profilSlika->path);
        $profilSlika->delete();

        return back()->with('status', 'Slika obrisana.');
    }
}