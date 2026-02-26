<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Chat sa: {{ $profil->ime }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <p class="text-gray-600">
                    Chat će biti implementiran kasnije. (Ovo je placeholder)
                </p>
            </div>
        </div>
    </div>
</x-app-layout>