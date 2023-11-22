<title> Login </title> 
        <link rel="stylesheet" href="{{asset('css/app.scss')}}" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Session Status -->
    <div id="authForm">
        
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div id="logo">
                <a href="{{url('/')}}">
                    <img src="{{url('images/pickleLogo.png')}}" /> 
                </a>
            </div>
        <!-- Email Address -->
        <div class="authInput">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="authInput">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="remMe" name="remember">
                <span class="remMe">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="forPass">
            @if (Route::has('password.request'))
                <a class="forPass" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <div class="authButton">
                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

        </div>
    </form>
</div>

