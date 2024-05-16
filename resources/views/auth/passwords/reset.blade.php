@extends('layouts.auth')

@section('template_title')
    Reset
@endsection

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
                        <div class="d-flex justify-content-center mb-4">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 260px; height: 70px;">
                            </a>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                    placeholder="{{ __('Email address') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 position-relative">
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="new-password" placeholder="{{ __('New password') }}"
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
                                    placeholder="{{ __('Confirm new password') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px; border-radius: 5px;">
                                <i class="fas fa-eye" id="toggleConfirmPassword"
                                    style="color: black; position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn"
                                    style="background-color: #9c2121; border: none; color: white; padding: 10px 20px; border-radius: 5px;">
                                    {{ __('Reset password') }}
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
        const passwordIcon = document.querySelector('#togglePassword i');
        const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
        const confirmPassword = document.querySelector('#password-confirm');
        const confirmPasswordIcon = document.querySelector('#toggleConfirmPassword i');

        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            passwordIcon.classList.toggle('fa-eye');
            passwordIcon.classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function(e) {
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            confirmPasswordIcon.classList.toggle('fa-eye');
            confirmPasswordIcon.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
