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
                    <input type="email" name="email" class="form-control" style="border: 1px solid #ced4da;" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telephone (required)</label>
                    <input type="text" name="phone" class="form-control" style="border: 1px solid #ced4da;" required>
                </div>
                <div class="form-group">
                    <label for="message">Your message (optional)</label>
                    <textarea name="message" class="form-control" style="border: 1px solid #ced4da;"></textarea>
                </div>
                <div class="form-check mt-3">
                    <input type="checkbox" name="privacy_policy" class="form-check-input" id="privacyPolicy" required>
                    <label class="form-check-label" for="privacyPolicy">I have read and accept the <a href="#">privacy policy</a>.</label>
                </div>
                <button type="submit" class="btn mt-3" style="background-color: #9c2121; color: white;">Send to</button>
            </form>
        </div>
        <div class="col-md-6 py-5">
            <img src="{{ asset('img/contact.png') }}" alt="Contact Image" class="img-fluid" style="border-radius: 10px;">
        </div>
    </div>
</div>

<style>
    .form-check {
 
    padding-left: 0em;
}
</style>