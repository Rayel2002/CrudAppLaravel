@extends('layouts.app')

@section('title', 'Reservering Bewerken')

@section('content')
<h1 class="text-2xl font-bold mb-4">Reservering Bewerken</h1>
@include('components.form', [
    'action' => route('reservations.update', $reservation->reservation_Id),
    'method' => 'PUT',
    'types' => $types,
    'reservation' => $reservation,
])
@endsection

