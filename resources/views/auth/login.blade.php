@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6 col-lg-4">

                <a href="{{ url('/') }}" class="return-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="card"
                    style="background-color: rgba(0, 0, 0, 0.8); color: white; padding: 20px; border-radius: 10px; text-align: center;">
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-8">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 260px; height: 70px;">
                            </a>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="{{ __('Email') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 position-relative">
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="current-password" placeholder="{{ __('Password') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                <i class="fas fa-eye" id="togglePassword" style="color: black;"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-check" style="text-align: left;">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember" style="color: white;">
                                    {{ __('Remember password') }}
                                </label>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-between align-items-start">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}"
                                            style="color: #ccc; text-decoration: none; padding-left: 0; margin-top: 3px;">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                    <button type="submit" class="btn"
                                        style="background-color: #9c2121; border: none; color: white; padding: 10px 20px; border-radius: 5px;">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // Alternar el tipo de entrada del campo de contraseña
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Cambiar el icono del ojo
            if (type === 'password') {
                togglePassword.classList.remove('fa-eye-slash');
                togglePassword.classList.add('fa-eye');
            } else {
                togglePassword.classList.remove('fa-eye');
                togglePassword.classList.add('fa-eye-slash');
            }
        });
    </script>
