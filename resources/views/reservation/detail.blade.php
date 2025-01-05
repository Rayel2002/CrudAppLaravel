@extends('layouts.app')

@section('title', 'Reservering Details')

@section('content')
    <x-card title="Details van Reservering">
        <div class="mb-4">
            <strong>Type:</strong> {{ $reservation->reservationType->name ?? 'Niet beschikbaar' }}
        </div>
        <div class="mb-4">
            <strong>Categorie:</strong> {{ $reservation->category->name ?? 'Niet beschikbaar' }}
        </div>
        <div class="mb-4">
            <strong>Start Tijd:</strong> {{ $reservation->start_time }}
        </div>
        <div class="mb-4">
            <strong>Eind Tijd:</strong> {{ $reservation->end_time }}
        </div>
        <div class="mb-4">
            <strong>Locatie:</strong> {{ $reservation->place }}
        </div>
        <div class="mb-4">
            <strong>Beschrijving:</strong> {{ $reservation->description }}
        </div>
        <div class="mb-4">
            <strong>Status:</strong> {{ $reservation->status->status ?? 'Niet beschikbaar' }}
        </div>

        <a href="{{ route('reservations.list') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Terug</a>
    </x-card>
@endsection
