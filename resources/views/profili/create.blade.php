<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kreiraj profil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('profili.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-label for="ime" value="Ime" />
                        <x-input id="ime" class="block mt-1 w-full" type="text" name="ime" value="{{ old('ime') }}" required />
                    </div>

                    {{-- Prezime --}}
<div class="mt-4">
    <x-label for="prezime" value="Prezime" />
    <x-input id="prezime" class="block mt-1 w-full" type="text" name="prezime"
             value="{{ old('prezime') }}" />
</div>

{{-- Zainteresovan/a za --}}
<div class="mt-4">
    <x-label value="Zainteresovan/a za" />
    <select name="zainteresovan_za" class="block mt-1 w-full rounded-lg border-gray-300">
        <option value="">-- odaberi --</option>
        <option value="musko"  @selected(old('zainteresovan_za') === 'musko')>Muško</option>
        <option value="zensko" @selected(old('zainteresovan_za') === 'zensko')>Žensko</option>
        <option value="oba"    @selected(old('zainteresovan_za') === 'oba')>Oba</option>
    </select>
</div>

{{-- Min/Max godine --}}
<div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <x-label for="min_godine" value="Min godine" />
        <x-input id="min_godine" class="block mt-1 w-full" type="number" name="min_godine" min="18" max="99"
                 value="{{ old('min_godine') }}" />
    </div>

    <div>
        <x-label for="max_godine" value="Max godine" />
        <x-input id="max_godine" class="block mt-1 w-full" type="number" name="max_godine" min="18" max="99"
                 value="{{ old('max_godine') }}" />
    </div>
</div>
</div>

                    <div class="mt-4">
                        <x-label for="datum_rodjenja" value="Datum rođenja" />
                        <x-input id="datum_rodjenja" class="block mt-1 w-full" type="date" name="datum_rodjenja" value="{{ old('datum_rodjenja') }}" required />
                    </div>

                    <div class="mt-4">
                        <x-label for="spol" value="Spol" />
                        <select id="spol" name="spol" class="block mt-1 w-full rounded-md border-gray-300 focus:border-pink-400 focus:ring-pink-400">
                            <option value="">Izaberi</option>
                            <option value="zensko" @selected(old('spol')==='Žensko')>Žensko</option>
                            <option value="musko" @selected(old('spol')==='Muško')>Muško</option>
                            <option value="drugo" @selected(old('spol')==='Ostalo')>Drugo</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <x-label for="grad" value="Grad" />
                        <x-input id="grad" class="block mt-1 w-full" type="text" name="grad" value="{{ old('grad') }}" required />
                    </div>

                    <div class="mt-4">
                        <x-label for="opis" value="Opis" />
                        <textarea id="opis" name="opis" rows="4" class="block mt-1 w-full rounded-md border-gray-300 focus:border-pink-400 focus:ring-pink-400">{{ old('opis') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <x-label for="profilna_slika" value="Profilna slika" />
                        <input id="profilna_slika" type="file" name="profilna_slika"
                               class="block mt-2 w-full text-sm text-gray-700" accept="image/*" />
                        <p class="text-xs text-gray-500 mt-1">JPG/PNG, max 2MB.</p>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-3">
                        <a href="{{ route('profili.index') }}" class="text-sm text-gray-600 hover:underline">
                            Nazad
                        </a>

                        <x-button class="bg-pink-600 hover:bg-pink-700">
                            Spasi profil
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>