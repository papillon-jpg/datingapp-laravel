<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 py-12 bg-gradient-to-br from-purple-50 via-white to-pink-50">
        <div class="w-full max-w-md">
            <div class="bg-white/80 backdrop-blur rounded-2xl shadow-xl border border-gray-100 p-8">
                <div class="flex items-center justify-center mb-6">
                    <x-authentication-card-logo />
                </div>

                <h1 class="text-2xl font-semibold text-gray-900 text-center">Registracija</h1>
                <p class="text-sm text-gray-600 text-center mt-1">
                    Napravi račun i kreni s upoznavanjem.
                </p>

                <x-validation-errors class="mt-6" />

                <form method="POST" action="{{ route('register') }}" class="mt-6">
                    @csrf

                    <div>
                        <x-label for="name" value="Ime i prezime:" />
                        <x-input
                            id="name"
                            class="block mt-1 w-full rounded-xl border-gray-200 focus:border-pink-400 focus:ring-pink-400"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Ime i prezime"
                        />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="Email" />
                        <x-input
                            id="email"
                            class="block mt-1 w-full rounded-xl border-gray-200 focus:border-pink-400 focus:ring-pink-400"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autocomplete="username"
                            placeholder="npr. sajra@email.com"
                        />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="Lozinka" />
                        <x-input
                            id="password"
                            class="block mt-1 w-full rounded-xl border-gray-200 focus:border-pink-400 focus:ring-pink-400"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="min. 8 karaktera"
                        />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="Potvrdi lozinku" />
                        <x-input
                            id="password_confirmation"
                            class="block mt-1 w-full rounded-xl border-gray-200 focus:border-pink-400 focus:ring-pink-400"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="ponovi lozinku"
                        />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <label for="terms" class="flex items-start gap-3">
                                <x-checkbox name="terms" id="terms" required />
                                <span class="text-sm text-gray-700">
                                    {!! __('Slažem se sa :terms_of_service i :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="text-pink-600 hover:text-pink-700 hover:underline">'.__('Uslovima korištenja').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="text-pink-600 hover:text-pink-700 hover:underline">'.__('Politikom privatnosti').'</a>',
                                    ]) !!}
                                </span>
                            </label>
                        </div>
                    @endif

                    <div class="mt-6">
                        <x-button class="w-full justify-center rounded-xl bg-pink-600 hover:bg-pink-700 focus:bg-pink-700 active:bg-pink-800">
                            Registruj se
                        </x-button>
                    </div>

                    <div class="mt-6 text-center text-sm text-gray-600">
                        Već imaš račun?
                        <a class="text-pink-600 hover:text-pink-700 hover:underline" href="{{ route('login') }}">
                            Prijavi se
                        </a>
                    </div>
                </form>
            </div>

            <p class="text-xs text-gray-500 text-center mt-6">
                © {{ date('Y') }} Dating App • Kreiraj profil i kreni
            </p>
        </div>
    </div>
</x-guest-layout>