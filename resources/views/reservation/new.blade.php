@extends('layouts.app')

@section('title', 'Nieuwe Reservering')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Nieuwe Reservering</h1>
        @include('components.form', [
            'action' => route('reservations.save'),
            'method' => 'POST',
            'types' => $types,
        ])
    </div>
@endsection
