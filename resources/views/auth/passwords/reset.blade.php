@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6 col-lg-4">

            <a href="{{ url('/') }}" class="return-icon">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div class="card" style="background-color: rgba(0, 0, 0, 0.8); color: white; padding: 20px; border-radius: 10px; text-align: center;">
                <div class="card-body">
                    <div class="d-flex justify-content-center mb-8">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 260px; height: 70px;">
                        </a>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Correo electrónico') }}" style="background-color: white; border: none; color: black; margin-bottom: 15px;">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <input id="password" type="password" class="form-control pe-5" name="password" required autocomplete="new-password" placeholder="{{ __('Nueva contraseña') }}" style="background-color: white; border: none; color: black; margin-bottom: 15px;">
                            <button type="button" id="togglePassword" class="btn position-absolute top-50 end-0 translate-middle-y" style="background-color: transparent; border: none; right: 10px;">
                                <i class="fas fa-eye text-dark" id="passwordIcon"></i>
                            </button>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <input id="password-confirm" type="password" class="form-control pe-5" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirmar nueva contraseña') }}" style="background-color: white; border: none; color: black; margin-bottom: 15px;">
                            <button type="button" id="toggleConfirmPassword" class="btn position-absolute top-50 end-0 translate-middle-y" style="background-color: transparent; border: none; right: 10px;">
                                <i class="fas fa-eye text-dark" id="confirmPasswordIcon"></i>
                            </button>
                        </div>

                        <div class="mb-0">
                            <button type="submit" class="btn" style="background-color: #9c2121; border: none; color: white; padding: 10px 20px; border-radius: 4px;">
                                {{ __('Restablecer contraseña') }}
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
    const passwordIcon = document.querySelector('#passwordIcon');
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const confirmPassword = document.querySelector('#password-confirm');
    const confirmPasswordIcon = document.querySelector('#confirmPasswordIcon');

    togglePassword.addEventListener('click', function(e) {
        // Toggle the password input field type
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // Toggle the eye icon for the password visibility
        passwordIcon.classList.toggle('fa-eye');
        passwordIcon.classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function(e) {
        // Toggle the confirm password input field type
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        // Toggle the eye icon for the confirm password visibility
        confirmPasswordIcon.classList.toggle('fa-eye');
        confirmPasswordIcon.classList.toggle('fa-eye-slash');
    });
</script>

@endsection