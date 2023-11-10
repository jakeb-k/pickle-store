<title> Register </title> 
<link rel="stylesheet" href="{{asset('css/app.scss')}}" type="text/css">
    <!-- Session Status -->
    <div id="regForm">

   
    <form method="POST" action="{{ route('register') }}">
         <div id="logo">
                <a href="{{url('/')}}">
                    <img src="{{url('images/pickleLogo.png')}}" /> 
                </a>
            </div>
        @csrf

        <!-- Name -->
        <div class="authInput">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="authInput">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!--Address-->
        <div class="authInput">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" type="text" name="address" :value="old('address')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="authInput">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="authInput">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="forPass">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <div class="authButton">
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
            </div>
        </div>
    </form>
</div>

