@extends('layouts.client')

@section('template_title')
    Rent Vehicle
@endsection
@section('content')
    <!-- Incluir Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="container my-5">
        <div class="row">
            <div class="col-md-7 mb-6 mb-md-0" style="padding: 0; overflow: hidden;">
                <!-- Bootstrap Carousel for Main Image with Rounded Corners -->
                <div id="carImageCarousel" class="carousel slide" data-bs-ride="carousel"
                    style="max-height: 400px; overflow: hidden; border-radius: 15px; margin: auto; width: 85%;">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/' . $car->image1) }}" class="d-block w-100 main-image"
                                alt="Car Image 1">
                        </div>
                        @if ($car->image2)
                            <div class="carousel-item">
                                <img src="{{ asset('storage/' . $car->image2) }}" class="d-block w-100 main-image"
                                    alt="Car Image 2">
                            </div>
                        @endif
                        @if ($car->image3)
                            <div class="carousel-item">
                                <img src="{{ asset('storage/' . $car->image3) }}" class="d-block w-100 main-image"
                                    alt="Car Image 3">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Thumbnails with Matching Width, Rounded Corners, and Precise Alignment -->
                <div class="d-flex justify-content-between product-card-container"
                    style="width: 85%; margin: 10px auto 0 auto; border-radius: 10px; overflow: hidden;">
                    <!-- Align width and margin with the carousel above -->
                    <img src="{{ asset('storage/' . $car->image1) }}" class="product-card-img cover-img"
                        data-bs-target="#carImageCarousel" data-bs-slide-to="0" class="active">
                    @if ($car->image2)
                        <img src="{{ asset('storage/' . $car->image2) }}" class="product-card-img cover-img"
                            data-bs-target="#carImageCarousel" data-bs-slide-to="1">
                        <!-- Increased margin -->
                    @endif
                    @if ($car->image3)
                        <img src="{{ asset('storage/' . $car->image3) }}" class="product-card-img cover-img"
                            data-bs-target="#carImageCarousel" data-bs-slide-to="2">
                    @endif
                </div>
            </div>
            <div class="col-md-5">
                <!-- Car Details -->
                <h2>{{ $car->brand }} {{ $car->model }} {{ $car->body }} {{ $car->horsepower }} HP
                    {{ $car->seats }}p.</h2>
                <h2 class="text-danger">{{ $car->price_per_hour }} €/H</h2>
                <p class="lead">
                    <span class="badge bg-success">{{ $car->available ? 'Available' : 'Not available' }}</span>
                </p>
                <div class="mb-4">
                    <h5>Color:</h5>
                    @switch($car->color)
                        @case('Red')
                            <span class="color-circle red-circle"></span>Red
                        @break

                        @case('Blue')
                            <span class="color-circle blue-circle"></span>Blue
                        @break

                        @case('Green')
                            <span class="color-circle green-circle"></span>Green
                        @break

                        @case('Yellow')
                            <span the="color-circle yellow-circle"></span>Yellow
                        @break

                        @case('Black')
                            <span the="color-circle black-circle"></span>Black
                        @break

                        @case('White')
                            <span the="color-circle white-circle"></span>White
                        @break

                        @case('Silver')
                            <span the="color-circle silver-circle"></span>Silver
                        @break

                        @default
                            <button class="btn btn-primary btn-sm">{{ $car->color }}</button>
                    @endswitch
                </div>
                <!-- Mini tabla con la información del coche -->
                <div class="mt-4">
                    <h5>Car Information:</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Body <h6> <strong>{{ $car->body }}</strong></h6>
                                </td>
                                <td>Seats <h6> <strong>{{ $car->seats }}</strong></h6>
                                </td>
                                <td>Gears <h6> <strong>{{ $car->gears }}</strong></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>Fuel <h6> <strong>{{ $car->fuel }}</strong></h6>
                                </td>
                                <td>Engine <h6> <strong>{{ $car->engine }} CC</strong></h6>
                                </td>
                                <td>Horsepower <h6> <strong>{{ $car->horsepower }} HP</strong></h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Rental Form -->
                <div class="container mt-4" style="width: 100%; padding: 0;">
                    <h5>Select Pickup and Drop-off Date and Time:</h5>
                    <form action="{{ route('car.rent', ['carId' => $car->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="pickup_date_time" class="form-label"> <i class="fas fa-calendar-alt"></i>
                                    Pickup: </label>
                                <input type="text" id="pickup_date_time" name="pickup_date_time" class="form-control"
                                    placeholder="Select Pickup Date and Time" required>
                            </div>
                            <div class="col-md-6">
                                <label for="dropoff_date_time" class="form-label"> <i class="fas fa-calendar-alt"></i>
                                    Drop-off: </label>
                                <input type="text" id="dropoff_date_time" name="dropoff_date_time" class="form-control"
                                    placeholder="Select Drop-off Date and Time" required readonly>
                            </div>
                        </div>
                        <h2 id="total_price_display">Total Price: 0 €</h2>
                        <input type="hidden" name="total_price" id="total_price_input">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Include Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        var pickupInput = flatpickr("#pickup_date_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            minTime: "08:00",
            maxTime: "20:00",
            disableMobile: true,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    const pickupDate = new Date(selectedDates[0].getTime() + 24 * 3600 *
                        1000); // Ensure 24 hours minimum
                    const formattedDate = flatpickr.formatDate(pickupDate, "Y-m-d H:i");
                    dropoffInput.setDate(formattedDate, true);
                    calculateTotal(); // Calcular el total cuando se eligen las fechas
                }
            }
        });

        // Inicializar Flatpickr para la fecha y hora de entrega
        var dropoffInput = flatpickr("#dropoff_date_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: new Date().fp_incr(1),
            minTime: "08:00",
            maxTime: "20:00",
            disableMobile: true
        });

        // Función para calcular el precio total
        function calculateTotal() {
            if (pickupInput.selectedDates[0] && dropoffInput.selectedDates[0]) {
                const pickupDateTime = pickupInput.selectedDates[0];
                const dropoffDateTime = dropoffInput.selectedDates[0];
                const diff = dropoffDateTime - pickupDateTime;
                const hours = diff / 3600000; // Convertir milisegundos en horas
                const total = hours * {
                    {
                        $car - > price_per_hour
                    }
                };
                document.getElementById('total_price_display').innerText = `Total Price: €${total.toFixed(2)}`;
                document.getElementById('total_price_input').value = total.toFixed(2);
            }
        }

        document.getElementById('pickup_date_time').addEventListener('change', calculateTotal);
        document.getElementById('dropoff_date_time').addEventListener('change', calculateTotal);
    </script>
@endsection
