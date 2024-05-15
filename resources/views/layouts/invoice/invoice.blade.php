<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background: #f4f4f4;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Invoice</h1>
            <p>Rental ID: {{ $rental->id }}</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2">User Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $user->phone }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2">Car Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Brand</td>
                    <td>{{ $rental->car->brand }}</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td>{{ $rental->car->model }}</td>
                </tr>
                <tr>
                    <td>Horsepower</td>
                    <td>{{ $rental->car->horsepower }} HP</td>
                </tr>
                <tr>
                    <td>Seats</td>
                    <td>{{ $rental->car->seats }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2">Rental Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Start Date</td>
                    <td>{{ $rental->start_date }}</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>{{ $rental->end_date }}</td>
                </tr>
                <tr>
                    <td>Total Price</td>
                    <td>€{{ $rental->total_price }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ ucfirst($rental->status) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <p>Thank you for renting with us!</p>
        </div>
    </div>
</body>
</html>
