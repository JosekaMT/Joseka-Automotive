@extends('layouts.client')

@section('template_title')
    Billing
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl"
            style="background-image: url('{{ asset('img/fondo-profile.jpg') }}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <h2 class="vehicle-heading2">Billing Information</h2>
            <table class="table" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Rental ID</th>
                        <th>User ID</th>
                        <th>Car ID</th>
                        <th>Client</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Price</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentals as $rental)
                        <tr>
                            <td>{{ $rental->id }}</td>
                            <td>{{ $rental->user_id }}</td>
                            <td>{{ $rental->car_id }}</td>
                            <td>{{ $rental->user->name }}</td>
                            <td>{{ $rental->car->brand }}</td>
                            <td>{{ $rental->car->model }}</td>
                            <td>{{ $rental->start_date }}</td>
                            <td>{{ $rental->end_date }}</td>
                            <td>{{ $rental->total_price }} €</td>
                            <td>
                                <a href="{{ route('admin.billing.downloadInvoice', $rental->id) }}" class="btn"
                                    style="background-color: #9c2121; color: white;">
                                    <i class="fas fa-download"></i> Download Invoice
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">No approved rentals found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
