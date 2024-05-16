@extends('layouts.client')

@section('content')
    <div class="container">
        <h1>Billing Information</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Rental ID</th>
                    <th>User ID</th>
                    <th>Car ID</th>
                    <th>User Name</th>
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
                        <td>{{ $rental->start_date }}</td>
                        <td>{{ $rental->end_date }}</td>
                        <td>{{ $rental->total_price }}</td>
                        <td><a href="{{ route('billing.downloadInvoice', $rental->id) }}" class="btn btn-primary">Download
                                Invoice</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No approved rentals found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
