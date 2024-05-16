@extends('layouts.auth')

@section('template_title')
    Verify
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

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                        <p>{{ __('If you did not receive the email') }}</p>

                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline"
                                style="color: #9c2121;">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
