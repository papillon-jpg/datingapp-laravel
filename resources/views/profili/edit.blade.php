<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Uredi profil
            </h2>

            <a href="{{ route('profili.show', $profil) }}"
               class="text-sm text-gray-600 hover:text-gray-900 underline">
                ← Nazad
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if (session('status'))
                    <div class="mb-4 text-green-600 text-sm font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                <x-validation-errors class="mb-4" />

                <form method="POST"
                      action="{{ route('profili.update', $profil) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-label for="ime" value="Ime" />
                        <x-input id="ime" class="block mt-1 w-full" type="text" name="ime"
                                 value="{{ old('ime', $profil->ime) }}" required />
                    </div>

                                        {{-- Prezime --}}
                    <div class="mt-4">
                        <x-label for="prezime" value="Prezime" />
                        <x-input id="prezime" class="block mt-1 w-full" type="text" name="prezime"
                                value="{{ old('prezime', $profil->prezime) }}" />
                    </div>

                    <div class="mt-4">
                        <x-label for="datum_rodjenja" value="Datum rođenja" />
                        <x-input id="datum_rodjenja" class="block mt-1 w-full" type="date" name="datum_rodjenja"
                                 value="{{ old('datum_rodjenja', $profil->datum_rodjenja) }}" required />
                    </div>


                    {{-- Zainteresovan/a za --}}
                    <div class="mt-4">
                        <x-label value="Zainteresovan/a za" />
                        <select name="zainteresovan_za" class="block mt-1 w-full rounded-lg border-gray-300">
                            <option value="">-- odaberi --</option>
                            <option value="musko"  @selected(old('zainteresovan_za', $profil->zainteresovan_za) === 'musko')>Muško</option>
                            <option value="zensko" @selected(old('zainteresovan_za', $profil->zainteresovan_za) === 'zensko')>Žensko</option>
                            <option value="oba"    @selected(old('zainteresovan_za', $profil->zainteresovan_za) === 'oba')>Oba</option>
                        </select>
                    </div>

                    {{-- Min/Max godine --}}
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-label for="min_godine" value="Min godine" />
                            <x-input id="min_godine" class="block mt-1 w-full" type="number" name="min_godine" min="18" max="99"
                                    value="{{ old('min_godine', $profil->min_godine) }}" />
                        </div>

                        <div>
                            <x-label for="max_godine" value="Max godine" />
                            <x-input id="max_godine" class="block mt-1 w-full" type="number" name="max_godine" min="18" max="99"
                                    value="{{ old('max_godine', $profil->max_godine) }}" />
                        </div>
                    </div>

                    
                    <div class="mt-4">
                        <x-label for="spol" value="Spol" />
                        <select id="spol" name="spol"
                                class="block mt-1 w-full rounded-md border-gray-300 focus:border-pink-500 focus:ring-pink-500">
                            <option value="Žensko" @selected(old('spol', $profil->spol) === 'Žensko')>Žensko</option>
                            <option value="Muško" @selected(old('spol', $profil->spol) === 'Muško')>Muško</option>
                            <option value="Ostalo" @selected(old('spol', $profil->spol) === 'Ostalo')>Ostalo</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-label for="grad" value="Grad" />
                        <x-input id="grad" class="block mt-1 w-full" type="text" name="grad"
                                 value="{{ old('grad', $profil->grad) }}" required />
                    </div>

                    <div class="mt-4">
                        <x-label for="opis" value="Opis" />
                        <textarea id="opis" name="opis" rows="5"
                                  class="block mt-1 w-full rounded-md border-gray-300 focus:border-pink-500 focus:ring-pink-500"
                                  placeholder="Napiši nešto o sebi...">{{ old('opis', $profil->opis) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <x-label for="profilna_slika" value="Profilna slika" />
                        <input id="profilna_slika" name="profilna_slika" type="file"
                               class="block mt-1 w-full" accept="image/*" />

                        @if($profil->profilna_slika)
                            <div class="mt-3">
                                <p class="text-sm text-gray-600 mb-2">Trenutna slika:</p>
                                <img src="{{ asset('storage/'.$profil->profilna_slika) }}"
                                     class="w-40 h-40 object-cover rounded-xl">
                            </div>
                        @endif
                    </div>

                    <div class="mt-6">
    <x-label for="slike" value="Moje slike (galerija)" />
    <input id="slike" name="slike[]" type="file" multiple accept="image/*"
           class="block mt-2 w-full text-sm text-gray-700" />

    <p class="text-xs text-gray-500 mt-1">Možeš izabrati više slika odjednom.</p>
</div>

@if($profil->slike->count())
    <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-3">
        @foreach($profil->slike as $s)
            <div class="relative">
                <img src="{{ asset('storage/'.$s->path) }}"
                     class="w-full h-32 object-cover rounded-xl border">

                <form method="POST" action="{{ route('profil-slike.destroy', $s) }}" class="absolute top-2 right-2">
    @csrf
    @method('DELETE')
    <button type="submit"
            onclick="return confirm('Obrisati sliku?')"
            class="w-8 h-8 rounded-full bg-black/60 text-white flex items-center justify-center hover:bg-black">
        ✕
    </button>
</form>
            </div>
        @endforeach
    </div>
@endif

                   <div class="mt-6 flex gap-4">
    <button type="submit"
            class="px-6 py-2 bg-pink-600 text-white rounded-xl hover:bg-pink-700">
        Sačuvaj
    </button>

    <a href="{{ route('profili.show', $profil) }}"
       class="px-6 py-2 border rounded-xl hover:bg-gray-100">
        Otkaži
    </a>
</div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>