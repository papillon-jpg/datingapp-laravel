<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pregled profila
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen bg-gradient-to-br from-pink-100 to-pink-200">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if(!$profil)
                <div class="bg-white shadow-xl sm:rounded-2xl p-10 text-center">
                    <div class="mx-auto w-16 h-16 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl">
                        💔
                    </div>

                    <h3 class="mt-5 text-2xl font-bold text-gray-900">
                        Nema novih profila
                    </h3>

                    <p class="mt-2 text-gray-600 max-w-md mx-auto">
                        Trenutno nema profila za pregled (ili si sve već pregledao/la).
                    </p>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('profili.index') }}"
                           class="inline-flex justify-center px-5 py-3 rounded-xl border border-gray-300 hover:bg-gray-50">
                            Pogledaj profile
                        </a>

                        <a href="{{ route('dashboard') }}"
                           class="inline-flex justify-center px-5 py-3 rounded-xl bg-pink-600 text-white hover:bg-pink-700">
                            Nazad na početnu
                        </a>
                    </div>
                </div>
            @else
                <div class="bg-white shadow-xl sm:rounded-2xl overflow-hidden">

                    {{-- Slika --}}
                    <div class="relative">
                        @if($profil->profilna_slika)
                            <img src="{{ asset('storage/'.$profil->profilna_slika) }}"
                                 class="w-full h-[420px] object-cover">
                        @else
                            <div class="w-full h-[420px] bg-gray-100 flex items-center justify-center text-gray-400">
                                Nema slike
                            </div>
                        @endif

                        {{-- “badge” gore --}}
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-xl text-sm font-semibold">
                            {{ $profil->grad ?? '—' }}
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">
                                    {{ $profil->ime }}
                                </h3>
                                <p class="text-gray-600">
                                    {{ $profil->spol ?? '' }}
                                    @if(!empty($profil->datum_rodjenja))
                                        • {{ \Carbon\Carbon::parse($profil->datum_rodjenja)->age }} god.
                                    @endif
                                </p>
                            </div>

                            <a href="{{ route('profili.show', $profil) }}"
                               class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Pogledaj detalje
                            </a>
                        </div>

                        @if($profil->opis)
                            <p class="mt-4 text-gray-700">
                                {{ $profil->opis }}
                            </p>
                        @endif

                        {{-- Dugmad --}}
                        <div class="mt-6 flex items-center justify-center gap-4">
                            <form method="POST" action="{{ route('browse.dislike', $profil->id) }}">
                                @csrf
                                <button type="submit"
                                        class="w-14 h-14 rounded-2xl bg-red-50 hover:bg-red-100 text-2xl flex items-center justify-center">
                                    ❌
                                </button>
                            </form>

                            <form method="POST" action="{{ route('browse.like', $profil->id) }}">
                                @csrf
                                <button type="submit"
                                        class="w-14 h-14 rounded-2xl bg-pink-50 hover:bg-pink-100 text-2xl flex items-center justify-center">
                                    ❤️
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>