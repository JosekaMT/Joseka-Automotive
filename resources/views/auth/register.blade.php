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

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <input id="name" type="text" class="form-control" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="{{ __('Full Name') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="{{ __('Email') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                    value="{{ old('phone_number') }}" required autocomplete="phone_number"
                                    placeholder="{{ __('Phone Number') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input id="city" type="text" class="form-control" name="city"
                                    value="{{ old('city') }}" required autocomplete="city"
                                    placeholder="{{ __('City') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input id="address" type="text" class="form-control" name="address"
                                    value="{{ old('address') }}" required autocomplete="address"
                                    placeholder="{{ __('Address') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 position-relative">
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="new-password" placeholder="{{ __('Password') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                <i class="fas fa-eye" id="togglePassword"
                                    style="color: black; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 position-relative">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="{{ __('Confirm Password') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                <i class="fas fa-eye" id="toggleConfirmPassword"
                                    style="color: black; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>

                            <div class="mb-4 text-center">
                                <span style="color: white;">{{ __('Already have an account?') }} <a
                                        href="{{ route('login') }}"
                                        style="color: #ccc; text-decoration: none;">{{ __('Login here') }}</a></span>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn"
                                    style="background-color: #9c2121; border: none; color: white; padding: 10px 20px; border-radius: 5px;">
                                    {{ __('Register') }}
                                </button>
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
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPassword = document.querySelector('#password-confirm');

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

        toggleConfirmPassword.addEventListener('click', function(e) {
            // Alternar el tipo de entrada del campo de confirmación de contraseña
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);

            // Cambiar el icono del ojo
            if (type === 'password') {
                toggleConfirmPassword.classList.remove('fa-eye-slash');
                toggleConfirmPassword.classList.add('fa-eye');
            } else {
                toggleConfirmPassword.classList.remove('fa-eye');
                toggleConfirmPassword.classList.add('fa-eye-slash');
            }
        });
    </script>
@endsection
