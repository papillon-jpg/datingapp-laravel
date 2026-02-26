<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profil
            </h2>

            <a href="{{ route('profili.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900 underline">
                ← Nazad na profile
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

                    {{-- Slika --}}
                    <div class="flex justify-center">
                        @if(!empty($profil->profilna_slika))
                            <img src="{{ asset('storage/'.$profil->profilna_slika) }}"
                                 class="w-72 h-72 object-cover rounded-2xl shadow">
                        @else
                            <div class="w-72 h-72 bg-gray-100 rounded-2xl flex items-center justify-center text-gray-400">
                                Nema slike
                            </div>
                        @endif
                    </div>

                    {{-- Podaci --}}
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
    {{ $profil->ime }} {{ $profil->prezime }}
</h1>

@if($profil->zainteresovan_za)
  <div class="text-gray-700 mt-1">Zainteresovan/a za: {{ $profil->zainteresovan_za }}</div>
@endif

@if($profil->min_godine || $profil->max_godine)
  <div class="text-gray-700 mt-1">
    Godine: {{ $profil->min_godine ?? '—' }} - {{ $profil->max_godine ?? '—' }}
  </div>
@endif

                        <p class="text-gray-600 mt-2">
                            {{ $profil->grad }} • {{ $profil->spol }}
                        </p>

                        @if(!empty($profil->datum_rodjenja))
                            <p class="text-gray-500 mt-2">
                                Datum rođenja: {{ \Carbon\Carbon::parse($profil->datum_rodjenja)->format('d.m.Y') }}
                            </p>
                        @endif

                        @if(!empty($profil->opis))
                            <div class="mt-5">
                                <h3 class="font-semibold text-gray-800">O meni</h3>
                                <p class="text-gray-700 mt-2">
                                    {{ $profil->opis }}
                                </p>
                            </div>
                        @endif

                        @if($profil->slike->count())
    <div class="mt-8">
        <h3 class="font-semibold text-gray-800 mb-3">Moje slike</h3>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            @foreach($profil->slike as $s)
                <img src="{{ asset('storage/'.$s->path) }}"
                     class="w-full h-32 object-cover rounded-2xl shadow-sm hover:shadow-md transition">
            @endforeach
        </div>
    </div>
@endif

                        <div class="mt-8 flex gap-3">

@if(auth()->id() === $profil->user_id)
    <div class="mt-8 flex gap-3">
        <a href="{{ route('profili.edit', $profil) }}"
           class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-50">
            Uredi
        </a>

        <form method="POST" action="{{ route('profili.destroy', $profil) }}"
              onsubmit="return confirm('Sigurno želiš obrisati profil?')">
            @csrf
            @method('DELETE')

            <button type="submit" class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700">
                Obriši
            </button>
        </form>
    </div>
@endif
</div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>