@extends('layouts.admin')

@section('content')
    <h3>Notificaciones</h3>
    @if($notifications->isEmpty())
        <p>No hay notificaciones nuevas.</p>
    @else
        <ul>
            @foreach ($notifications as $notification)
                <li>{{ $notification->data['message'] }}</li>
            @endforeach
        </ul>
    @endif
@endsection
