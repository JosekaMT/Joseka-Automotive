@extends('layouts.client')

@section('template_title')
    Rent Vehicle
@endsection

@section('content')
    <!-- Incluir Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Estilos personalizados para el calendario */
        .flatpickr-calendar {
            animation: fadeIn 0.3s ease-in-out;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .flatpickr-calendar .flatpickr-day {
            transition: all 0.3s ease-in-out;
            position: relative;
        }

        .flatpickr-calendar .flatpickr-day.selected,
        .flatpickr-calendar .flatpickr-day.startRange,
        .flatpickr-calendar .flatpickr-day.endRange,
        .flatpickr-calendar .flatpickr-day.selected.inRange,
        .flatpickr-calendar .flatpickr-day.selected:focus,
        .flatpickr-calendar .flatpickr-day.selected:hover,
        .flatpickr-calendar .flatpickr-day.startRange:focus,
        .flatpickr-calendar .flatpickr-day.startRange:hover,
        .flatpickr-calendar .flatpickr-day.endRange:focus,
        .flatpickr-calendar .flatpickr-day.endRange:hover,
        .flatpickr-calendar .flatpickr-day.selected.inRange:focus,
        .flatpickr-calendar .flatpickr-day.selected.inRange:hover {
            background-color: #9c2121 !important;
            border-color: #9c2121 !important;
            color: #fff !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .flatpickr-calendar .flatpickr-day.today {
            background-color: #f5c6c6 !important;
            /* Rojo más claro cuando es hoy */
            border-color: #f5c6c6 !important;
            /* Rojo más claro cuando es hoy */
            color: #000 !important;
            /* Color de texto negro */
            border-radius: 50%;
        }

        .flatpickr-calendar .flatpickr-day.today.selected {
            background-color: #9c2121 !important;
            /* Rojo cuando hoy es seleccionado */
            border-color: #9c2121 !important;
            /* Rojo cuando hoy es seleccionado */
            color: #fff !important;
            /* Color de texto blanco */
        }

        .flatpickr-calendar .flatpickr-day:hover {
            background-color: #f5c6c6 !important;
            /* Rojo más claro al pasar el ratón por encima */
            border-color: #f5c6c6 !important;
            /* Rojo más claro */
            color: #000 !important;
            /* Color de texto negro */
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .flatpickr-time input:hover,
        .flatpickr-time input:focus,
        .flatpickr-time .flatpickr-am-pm:hover,
        .flatpickr-time .flatpickr-am-pm:focus {
            background-color: #f5c6c6 !important;
            /* Rojo más claro al pasar el ratón por encima */
            border-color: #f5c6c6 !important;
            /* Rojo más claro */
            color: #000 !important;
            /* Color de texto negro */
            transition: background-color 0.3s, color 0.3s;
        }

        /* Añadir borde a los campos de entrada de fecha */
        .form-control.flatpickr-input {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 0.375rem 0.75rem;
            transition: border-color 0.2s;
        }

        .form-control.flatpickr-input:focus {
            border-color: #9c2121;
            box-shadow: 0 0 5px rgba(156, 33, 33, 0.5);
        }
    </style>

    <div class="container my-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-7 mb-6 mb-md-0" style="padding: 0; overflow: hidden;">
                <!-- Bootstrap Carousel for Main Image with Rounded Corners -->
                <div id="carImageCarousel" class="carousel slide" data-bs-ride="carousel"
                    style="max-height: 400px; overflow: hidden; border-radius: 10px; margin: auto; width: 85%;">
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
                <h2 class="vehicle-heading2">{{ $car->brand }} {{ $car->model }}
                    {{ $car->horsepower }} HP {{ $car->seats }}p.</h2>
                <h2 class="vehicle-heading2 text-danger">{{ $car->price_per_hour }} €/H</h2>
                <p class="lead" style="font-size: 0.9em;">
                    <span class="badge bg-success">{{ $car->available ? 'Available' : 'Not available' }}</span>
                </p>
                <!-- Mini tabla con la información del coche -->
                <div class="mt-4">
                    <h5>Car Information:</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Brand <h6><strong>{{ $car->brand }}</strong></h6>
                                </td>
                                <td>Body <h6><strong>{{ $car->body }}</strong></h6>
                                </td>
                                <td>Seats <h6><strong>{{ $car->seats }} Seats</strong></h6>
                                </td>
                                <td>Color <h6><strong>
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
                                                    <span class="color-circle yellow-circle"></span>Yellow
                                                @break

                                                @case('Black')
                                                    <span class="color-circle black-circle"></span>Black
                                                @break

                                                @case('White')
                                                    <span class="color-circle white-circle"></span>White
                                                @break

                                                @case('Silver')
                                                    <span class="color-circle silver-circle"></span>Silver
                                                @break

                                                @default
                                                    <button class="btn btn-primary btn-sm">{{ $car->color }}</button>
                                            @endswitch
                                        </strong></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>Fuel <h6><strong>{{ $car->fuel }}</strong></h6>
                                </td>
                                <td>Engine <h6><strong>{{ $car->engine }} CC</strong></h6>
                                </td>
                                <td>Horsepower <h6><strong>{{ $car->horsepower }} HP</strong></h6>
                                </td>
                                <td>Gears <h6><strong>{{ $car->gears }}</strong></h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Rental Form -->
                <div class="container" style="width: 100%; padding: 0;">
                    <h5>Select Pickup and Drop-off Date and Time:</h5>
                    <form action="{{ route('car.rent', ['carId' => $car->id]) }}" method="POST">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="pickup_date_time" class="form-label"> <i class="fas fa-calendar-alt"></i>
                                    Pickup: </label>
                                <input type="text" id="pickup_date_time" name="pickup_date_time"
                                    class="form-control flatpickr-input" placeholder="Select Pickup Date and Time" required>
                            </div>
                            <div class="col-md-6">
                                <label for="dropoff_date_time" class="form-label"> <i class="fas fa-calendar-alt"></i>
                                    Drop-off: </label>
                                <input type="text" id="dropoff_date_time" name="dropoff_date_time"
                                    class="form-control flatpickr-input" placeholder="Select Drop-off Date and Time"
                                    required readonly>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-danger" style="background-color: #9c2121;">RENT
                                    NOW!</button>
                            </div>
                            <div class="col-md-8 text-end">
                                <h2 id="total_price_display" class="vehicle-heading2">Total Price: 0 €</h2>
                                <input type="hidden" name="total_price" id="total_price_input">
                            </div>
                        </div>
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
                    dropoffInput.set('minDate', pickupDate);
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
                const total = hours * {{ $car->price_per_hour }};
                document.getElementById('total_price_display').innerText = `Total Price: €${total.toFixed(2)}`;
                document.getElementById('total_price_input').value = total.toFixed(2);
            }
        }

        document.getElementById('pickup_date_time').addEventListener('change', calculateTotal);
        document.getElementById('dropoff_date_time').addEventListener('change', calculateTotal);

        // Prevenir números negativos en los campos de entrada
        document.querySelectorAll('input[type="number"]').forEach(function(input) {
            input.addEventListener('input', function() {
                if (this.value < 0) {
                    this.value = 0;
                }
            });
        });
    </script>
@endsection
