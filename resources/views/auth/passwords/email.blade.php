@extends('layouts.auth')

@section('template_title')
    Email
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
                        <div class="d-flex justify-content-center mb-8">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 260px; height: 70px;">
                            </a>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="{{ __('Email') }}"
                                    style="background-color: white; border: none; color: black; margin-bottom: 15px;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn"
                                    style="background-color: #9c2121; border: none; color: white; padding: 10px 20px; border-radius: 4px;">
                                    {{ __('Send password reset link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
