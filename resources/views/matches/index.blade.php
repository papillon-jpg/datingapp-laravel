<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Match
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-10">

            {{-- LAJKOVANI --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">❤️ Osobe koje si lajkao/la</h3>

                @if($likedProfils->isEmpty())
                    <p class="text-gray-600">Još nema lajkova.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach($likedProfils as $p)
                            <a href="{{ route('profili.show', $p) }}" class="border rounded-2xl p-4 hover:shadow-md transition">
                                <div class="flex items-center gap-3">
                                    <img
                                        src="{{ $p->profilna_slika ? asset('storage/'.$p->profilna_slika) : 'https://via.placeholder.com/80' }}"
                                        class="w-16 h-16 rounded-xl object-cover"
                                    >
                                    <div>
                                        <div class="font-semibold">{{ $p->ime }}</div>
                                        <div class="text-sm text-gray-600">{{ $p->grad }} • {{ $p->spol }}</div>
                                    </div>

                                    <form method="POST" action="{{ route('likes.undo', $p->id) }}" class="mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm px-3 py-1 rounded-lg border hover:bg-gray-50">
                                        Undo
                                    </button>
                                </form>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- DISLAJKOVANI --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">❌ Osobe koje si dislajkao/la</h3>

                @if($dislikedProfils->isEmpty())
                    <p class="text-gray-600">Još nema dislajkova.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach($dislikedProfils as $p)
                            <div class="border rounded-2xl p-4 opacity-90">
                                <div class="flex items-center gap-3">
                                    <img
                                        src="{{ $p->profilna_slika ? asset('storage/'.$p->profilna_slika) : 'https://via.placeholder.com/80' }}"
                                        class="w-16 h-16 rounded-xl object-cover"
                                    >
                                    <div>
                                        <div class="font-semibold">{{ $p->ime }}</div>
                                        <div class="text-sm text-gray-600">{{ $p->grad }} • {{ $p->spol }}</div>
                                    </div>

                                    <form method="POST" action="{{ route('dislikes.undo', $p->id) }}" class="mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm px-3 py-1 rounded-lg border hover:bg-gray-50">
                                        Undo
                                    </button>
                                </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- MATCH --}}
<div class="bg-white shadow sm:rounded-lg p-6">
    <h3 class="text-lg font-bold mb-4">✨ It's a match</h3>

    @if($matches->isEmpty())
        <p class="text-gray-600">Još nema match-eva.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($matches as $p)

                <div class="border rounded-2xl p-4 hover:shadow-md transition">

                    <div class="flex items-center gap-3">

                        <img
                        src="{{ $p->profilna_slika ? asset('storage/'.$p->profilna_slika) : 'https://via.placeholder.com/80' }}"
                        class="w-16 h-16 rounded-xl object-cover">

                        <div class="flex-1">

                            <div class="font-semibold">
                                {{ $p->ime }}
                            </div>

                            <div class="text-sm text-gray-600">
                                {{ $p->grad }} • {{ $p->spol }}
                            </div>

                            <div class="text-xs mt-1 text-pink-600 font-semibold">
                                It's a match ✨
                            </div>

                            {{-- CHAT DUGME --}}
                            <a href="#"
                               class="inline-block mt-2 px-3 py-1 bg-pink-600 text-white rounded-lg text-sm hover:bg-pink-700">
                               💬 Chat
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach
        </div>
    @endif
</div>

        </div>
    </div>
</x-app-layout>