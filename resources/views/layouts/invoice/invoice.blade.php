<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing · Joseka Automotive</title>
    <link rel="stylesheet" href="{{ public_path('css/style-billing.css') }}" type="text/css" media="all" />

</head>

<body>
    <div>
        <div class="py-4">
            <div class="px-14 py-6">
                <table class="w-full border-collapse border-spacing-0">
                    <tbody>
                        <tr>
                            <td class="w-full align-top">
                                <div>
                                    <img src="{{ public_path('img/logo2.png') }}" alt="Company Logo" class="h-12">
                                </div>
                            </td>

                            <td class="align-top">
                                <div class="text-sm">
                                    <table class="border-collapse border-spacing-0">
                                        <tbody>
                                            <tr>
                                                <td class="border-r pr-4">
                                                    <div>
                                                        <p class="whitespace-nowrap font-bold text-right">Date</p>
                                                        <p class="whitespace-nowrap font-bold text-main text-right">
                                                            {{ \Carbon\Carbon::parse($rental->updated_at)->format('l, F j, Y') }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="pl-4">
                                                    <div>
                                                        <p class="whitespace-nowrap font-bold text-right">Invoice #
                                                        </p>
                                                        <p class="whitespace-nowrap font-bold text-main text-right">
                                                            RENT-{{ $rental->id }}
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-slate-100 px-14 py-6 text-sm">
                <table class="w-full border-collapse border-spacing-0">
                    <tbody>
                        <tr>
                            <td class="w-1/2 align-top">
                                <div class="text-sm text-neutral-600">
                                    @if (isset($admin))
                                        <h2 class="whitespace-nowrap font-bold text-main">JOSEKA AUTOMOTIVE</h2><br>
                                        <p class="font-bold">{{ $admin->name }}</p>
                                        <p>Email: {{ $admin->email }}</p>
                                        <p>Phone: {{ $admin->phone_number ?? 'N/A' }}</p>
                                        <p>City: {{ $admin->city ?? 'N/A' }}</p>
                                        <p>Address: {{ $admin->address ?? 'N/A' }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="w-1/2 align-top text-right">
                                <div class="text-sm text-neutral-600">
                                    <h2 class="whitespace-nowrap font-bold text-main">CLIENT</h2><br>
                                    <p class="font-bold">{{ $rental->user->name }}</p>
                                    <p>Email: {{ $rental->user->email }}</p>
                                    <p>Phone: {{ $rental->user->phone_number ?? 'N/A' }}</p>
                                    <p>City: {{ $rental->user->city ?? 'N/A' }}</p>
                                    <p>Address: {{ $rental->user->address ?? 'N/A' }}</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-14 py-10 text-sm text-neutral-700">
                <table class="w-full border-collapse border-spacing-0">
                    <thead>
                        <tr>
                            <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">Id</td>
                            <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Vehicle</td>
                            <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Body</td>
                            <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Fuel</td>
                            <td class="border-b-2 border-main pb-3 pl-2 font-bold text-main">Gears</td>
                            <td class="border-b-2 border-main pb-3 pl-2 text-right font-bold text-main">Engine</td>
                            <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Horsepower</td>
                            <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Seats</td>
                            <td class="border-b-2 border-main pb-3 pl-2 text-center font-bold text-main">Color</td>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-b py-3 pl-2">{{ $rental->car->id }}</td>
                            <td class="border-b py-3 pl-2">{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                            <td class="border-b py-3 pl-2">{{ $rental->car->body }}</td>
                            <td class="border-b py-3 pl-2">{{ $rental->car->fuel }}</td>
                            <td class="border-b py-3 pl-2">{{ $rental->car->gears }}</td>
                            <td class="border-b py-3 pl-2 text-right">{{ $rental->car->engine }} CC</td>
                            <td class="border-b py-3 pl-2 text-center">{{ $rental->car->horsepower }} HP</td>
                            <td class="border-b py-3 pl-2 text-center">{{ $rental->car->seats }}</td>
                            <td class="border-b py-3 pl-2 text-center">{{ $rental->car->color }}</td>

                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-14 py-2 text-sm text-neutral-700">
                <table class="w-full border-collapse border-spacing-0">
                    <thead>
                        <tr>
                            <td class="border-b-2 border-main pb-3 pl-3 font-bold text-main">Rental Details</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-b py-3 pl-3">Start Date: {{ $rental->start_date }}</td>
                        </tr>
                        <tr>
                            <td class="border-b py-3 pl-3">End Date: {{ $rental->end_date }}</td>
                        </tr>
                        <tr>

                            <td class="border-b py-3 pl-3">Price Per Hour: €{{ $rental->car->price_per_hour }}</td>
                        </tr>

                        <tr>
                            <td class="border-b py-3 pl-3">Status: {{ ucfirst($rental->status) }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="px-14 py-2 text-sm text-neutral-700">
                <table class="w-full border-collapse border-spacing-0">
                    <tbody>
                        <tr>
                            <td class="border-b p-3">
                                <div class="whitespace-nowrap text-slate-400">SubTotal:</div>
                            </td>
                            <td class="border-b p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-main">{{ $rental->total_price }} €</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-3">
                                <div class="whitespace-nowrap text-slate-400">Amount paid:</div>
                            </td>
                            <td class="p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-main">0.00 €</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-main p-3">
                                <div class="whitespace-nowrap font-bold text-white">Total Price:</div>
                            </td>
                            <td class="bg-main p-3 text-right">
                                <div class="whitespace-nowrap font-bold text-white">{{ $rental->total_price }} €</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-14 py-10 text-sm text-neutral-700">
                <p class="text-main font-bold">SIGNATURE:</p>

            </div>
            @if (isset($admin))
                <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
                    Joseka Automotive
                    <span class="text-slate-300 px-2">|</span>
                    {{ $admin->email }}
                    <span class="text-slate-300 px-2">|</span>
                    {{ $admin->phone_number ?? 'N/A' }}
                </footer>
            @endif
