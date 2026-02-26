<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
            <div class="text-center mb-6">
                <div class="text-4xl">❤️</div>
                <h1 class="text-2xl font-bold mt-2">DatingApp</h1>
                <p class="text-gray-500 text-sm">Pronađi svoju osobu</p>
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="Email" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                             :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="Lozinka" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password"
                             required autocomplete="current-password" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <label class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">Zapamti me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-pink-600 hover:underline" href="{{ route('password.request') }}">
                            Zaboravljena lozinka?
                        </a>
                    @endif
                </div>

                <div class="mt-6">
                    <x-button class="w-full justify-center bg-pink-600 hover:bg-pink-700">
                        Prijavi se
                    </x-button>
                </div>
            </form>

            <div class="text-center mt-6 text-sm text-gray-600">
                Nemaš račun?
                <a href="{{ route('register') }}" class="text-pink-600 font-semibold hover:underline">
                    Registruj se
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>