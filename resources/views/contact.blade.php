@extends('layouts.client')

@section('template_title')
    Contact
@endsection

@section('content')
<!-- Contact Information -->
<div class="container mt-5">
    <h2 class="vehicle-heading text-center">Contact us</h2>
    <div class="row py-5">
        <div class="col-md-6">
            <div class="contact-info mb-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon icon-lg icon-shape text-white text-center border-radius-xl" style="background-color: #9c2121;">
                        <i class="material-icons">location_on</i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-uppercase">Find us</h5>
                        <p class="mb-0">C. Alcalde Retamino, 1, 41510 Mairena del Alcor, Sevilla</p>
                    </div>
                </div>
                <hr class="my-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon icon-lg icon-shape text-white text-center border-radius-xl" style="background-color: #9c2121;">
                        <i class="material-icons">mail_outline</i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-uppercase">Email us</h5>
                        <p class="mb-0">admin@example.com</p>
                    </div>
                </div>
                <hr class="my-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon icon-lg icon-shape text-white text-center border-radius-xl" style="background-color: #9c2121;">
                        <i class="material-icons">call</i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-uppercase">Call us</h5>
                        <p class="mb-0">+34 677 27 57 27</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1540.1149104725657!2d-5.749943561033144!3d37.3783037067036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd1263f35e22c967%3A0x6142ef35069f040c!2sAutom%C3%B3viles%20Monicars!5e0!3m2!1ses!2ses!4v1716165657804!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

<style>
    .contact-info .icon {
        width: 50px;
        height: 50px;
    }

    .contact-info h5 {
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .contact-info p {
        margin-bottom: 0;
    }

    .ms-3 {
        margin-left: 1rem;
    }
</style>


    <!-- Formulario de Contacto -->
    <div class="container">
        <h2 class="vehicle-heading">Sell your vehicle</h2>
        <div class="row">
            <div class="col-md-6 py-5">
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name (required)</label>
                        <input type="text" name="name" class="form-control" style="border: 1px solid #ced4da;" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email (required)</label>
                        <input type="email" name="email" class="form-control" style="border: 1px solid #ced4da;"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telephone (required)</label>
                        <input type="text" name="phone" class="form-control" style="border: 1px solid #ced4da;"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your message (optional)</label>
                        <textarea name="message" class="form-control" style="border: 1px solid #ced4da;"></textarea>
                    </div>
                    <div class="form-check mt-3">
                        <input type="checkbox" name="privacy_policy" class="form-check-input" id="privacyPolicy" required>
                        <label class="form-check-label" for="privacyPolicy">I have read and accept the <a
                                href="#">privacy policy</a>.</label>
                    </div>
                    <button type="submit" class="btn mt-3" style="background-color: #9c2121; color: white;">Send
                        to</button>
                </form>
            </div>
            <div class="col-md-6 py-5">
                <img src="{{ asset('img/contact.png') }}" alt="Contact Image" class="img-fluid"
                    style="border-radius: 10px;">
            </div>
        </div>
    </div>

    <style>
        .form-check {

            padding-left: 0em;
        }
    </style>
@endsection
