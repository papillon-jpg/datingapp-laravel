<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profili
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($profili->count() === 0)
                    <p class="text-gray-600">Još nema profila. Klikni "Dodaj profil".</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($profili as $p)
            <a href="{{ route('profili.show', $p->id) }}" class="block">
                <div class="border rounded-2xl p-5 shadow-sm hover:shadow-lg transition cursor-pointer">

                    @php
    $img = $p->profilna_slika ?: optional($p->slike->first())->path;
@endphp

@if($img)
    <img src="{{ asset('storage/'.$img) }}"
         class="w-48 h-48 object-cover rounded-xl mb-4 mx-auto">
@else
    <div class="w-full h-56 bg-gray-100 rounded-xl mb-4 flex items-center justify-center text-gray-400">
        Nema slike
    </div>
@endif

                    {{-- IME --}}
                    <div class="font-bold text-lg">
                        {{ $p->ime }}
                    </div>

                    <div class="text-sm text-gray-600">
                        @if($p->godine)
                            {{ $p->godine }} godina •
                        @endif
                        {{ $p->grad }} • {{ $p->spol }}
                    </div>

                    {{-- OPIS --}}
                    @if($p->opis)
                        <p class="text-sm text-gray-700 mt-3">
                            {{ $p->opis }}
                        </p>
                    @endif

                </div>
            </a>
        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>