<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfilSlika;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
{
    $profili = \App\Models\Profil::with('slike')->latest()->get();
    return view('profili.index', compact('profili'));
}

    private function ensureOwner(Profil $profil)
    {
        abort_unless(auth()->id() === $profil->user_id, 403);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    // ako user već ima profil, ne dozvoli drugi
    if (Auth::user()->profil) {
        return redirect()->route('profili.index')
            ->with('status', 'Već imaš kreiran profil.');
    }

    return view('profili.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'ime' => ['required', 'string', 'max:255'],
        'datum_rodjenja' => ['required', 'date'],
        'spol' => ['required', 'string', 'max:50'],
        'grad' => ['required', 'string', 'max:255'],
        'opis' => ['nullable', 'string', 'max:2000'],
        'profilna_slika' => ['nullable', 'image', 'max:2048'],
        'prezime' => ['nullable', 'string', 'max:255'],
'zainteresovan_za' => ['nullable', 'in:musko,zensko,oba'],
'min_godine' => ['nullable', 'integer', 'min:18', 'max:99'],
'max_godine' => ['nullable', 'integer', 'min:18', 'max:99', 'gte:min_godine'],
    ]);

    // upload slike (ako postoji)
    if ($request->hasFile('profilna_slika')) {
        $data['profilna_slika'] = $request->file('profilna_slika')->store('profili', 'public');
    }

    $data['user_id'] = Auth::id();

    // ako user već ima profil, ne dozvoli drugi
    if (Auth::user()->profil) {
        return redirect()->route('profili.index')->with('status', 'Već imaš kreiran profil.');
    }

    Profil::create($data);

    return redirect()->route('profili.index')->with('status', 'Profil je uspješno kreiran!');
}

    /**
     * Display the specified resource.
     */
    public function show(Profil $profil)
{
    $profil->load('slike');
    return view('profili.show', compact('profil'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profil $profil)
{
    $this->ensureOwner($profil);
    $profil->load('slike');
    return view('profili.edit', compact('profil'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profil $profil)
    {
            $this->ensureOwner($profil);
        $data = $request->validate([
        'ime' => ['required', 'string', 'max:255'],
        'datum_rodjenja' => ['required', 'date'],
        'spol' => ['required', 'string', 'max:50'],
        'grad' => ['required', 'string', 'max:255'],
        'opis' => ['nullable', 'string', 'max:2000'],
        'profilna_slika' => ['nullable', 'image', 'max:2048'],
        'prezime' => ['nullable', 'string', 'max:255'],
'zainteresovan_za' => ['nullable', 'in:musko,zensko,oba'],
'min_godine' => ['nullable', 'integer', 'min:18', 'max:99'],
'max_godine' => ['nullable', 'integer', 'min:18', 'max:99', 'gte:min_godine'],
    ]);

    // ako je došla nova slika
    if ($request->hasFile('profilna_slika')) {
        $data['profilna_slika'] = $request->file('profilna_slika')->store('profili', 'public');
    }

    $profil->update($data);
    if ($request->hasFile('slike')) {
    foreach ($request->file('slike') as $img) {
        $path = $img->store('profili/galerija', 'public');

        ProfilSlika::create([
            'profil_id' => $profil->id,
            'path' => $path,
        ]);
    }
}

    return redirect()->route('profili.show', $profil)->with('status', 'Profil je ažuriran!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profil)
    {
        $this->ensureOwner($profil);
    $profil->delete();
    return redirect()->route('profili.index')->with('status', 'Profil obrisan.');
    }
}
