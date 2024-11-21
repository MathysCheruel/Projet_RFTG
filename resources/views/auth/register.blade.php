<x-guest-layout>
    <div class="login-container flex">
        <!-- Left Section with Background Image -->
        <div style="flex-basis:60%; height:auto;" class="left-section flex-1 relative">
            <img src="{{ asset('img/mtb111_identite_RSE_environnementale.png') }}" alt="MTB111 Identity" class="absolute inset-0 object-cover w-full h-full hand">
        </div>

        <!-- Right Section with Login Form -->
        <div style="flex-basis:40%; position:relative;" class="right-section flex-1 flex items-center justify-center bg-white bg-opacity-80">
            <x-auth-card>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
            

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" style="zoom: 1" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" :value="__('Nom')">
                            {{ __('Nom') }}
                        </label>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <label for="email" :value="__('Email')">
                            {{ __('Email') }}
                        </label>

                        <span class="flex" style="flex-direction: row">
                            <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus/>                            
                        </span>
                    </div>
                    

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" :value="__('Mot de passe')">
                            {{ __('Mot de passe') }}
                        </label>
                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="password_confirmation" :value="__('Confirmer le mot de passe')">
                            {{ __('Confirmer mot de passe') }}
                        </label>
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required />
                    </div>

                    <div class="flex items-center mt-4 justify-end">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" style="margin-right:25px" href="{{ route('login') }}">
                            {{ __('Déjà inscrit ?') }}
                        </a>

                        <x-button class="ml-4 flex">
                            {{ __('S\'inscrire') }}
                        </x-button>
                    </div>
                </form>
            </x-auth-card>
            <img src="{{ asset('img/right_connexion_image.jpg') }}" alt="MTB111 Identity" style="position:absolute; z-index:-1; width:auto;" class="absolute inset-0 object-cover w-full h-full hand">
        </div>
    </div>
</x-guest-layout>