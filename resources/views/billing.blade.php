@extends('layouts.client')

@section('template_title')
    Billing
@endsection

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Billing Information</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Rental ID</th>
                    <th>Car</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Invoice</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentals as $rental)
                    <tr>
                        <td>{{ $rental->id }}</td>
                        <td>{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                        <td>{{ $rental->start_date }}</td>
                        <td>{{ $rental->end_date }}</td>
                        <td>€{{ $rental->total_price }}</td>
                        <td>{{ ucfirst($rental->status) }}</td>
                        <td>
                            <a href="{{ route('download.invoice', $rental->id) }}" class="btn btn-sm btn-primary">
                                <i class="material-icons">file_download</i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
