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
                @if(session('error'))
                    <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 text-green-600 p-3 rounded mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif            

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" style="zoom: 1; z-index:2;" action="{{ route('login_staff') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mt-4">
                        <label for="email" class="flex items-center text-sm font-bold">
                            <i class="fa-solid fa-user"></i>
                            {{ __('Identifiant') }}
                        </label>
                        <span class="flex" style="flex-direction: row">
                            <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus/>
                            <p style="margin-top: auto;position: relative;left:5px;top: 2px;text-align: left;margin-bottom: auto;"></p>
                        </span>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="flex items-center text-sm font-bold">
                            <i class="fa-solid fa-lock"></i>
                            {{ __('Mot de passe') }}  
                        </label>
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        <div class="mt-2 text-right">
                            
                        </div>
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        @if (Route::has('register'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                                {{ __('Créer un compte') }}
                            </a>
                        @endif

                        <x-button class="ml-3" style="position: relative; font-size: 10px; padding: 5px 9px">
                            {{ __('Connexion') }}
                        </x-button>
                    </div>
                </form>
            </x-auth-card>
            <img src="{{ asset('img/right_connexion_image.jpg') }}" alt="MTB111 Identity" style="position:absolute; z-index:-1; width:auto;" class="absolute inset-0 object-cover w-full h-full hand">
        </div>
    </div>
</x-guest-layout>