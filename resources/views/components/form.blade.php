@extends('layouts.app')

@section('title', 'Nieuwe Reservering')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Nieuwe Reservering</h1>
        <form action="{{ $action }}" method="POST" class="space-y-4">
            @csrf
            @if(isset($method) && $method === 'PUT')
                @method('PUT')
            @endif
            <!-- Type veld -->
            <div>
                <label for="type_Id" class="block text-gray-700">Type Reservering:</label>
                <select id="type_Id" name="type_Id" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="" disabled {{ isset($reservation) ? '' : 'selected' }}>Kies een type
                    </option>
                    @foreach ($types as $type)
                        <option value="{{ $type->type_Id }}"
                            {{ isset($reservation) && $reservation->type_Id == $type->type_Id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Start Tijd -->
            <div>
                <label for="start_time" class="block text-gray-700">Start Tijd:</label>
                <input type="time" id="start_time" name="start_time" class="w-full border border-gray-300 rounded p-2"
                    value="{{ isset($reservation) ? $reservation->start_time : old('start_time') }}" required>
            </div>

            <!-- Eind Tijd -->
            <div>
                <label for="end_time" class="block text-gray-700">Eind Tijd:</label>
                <input type="time" id="end_time" name="end_time" class="w-full border border-gray-300 rounded p-2"
                    value="{{ isset($reservation) ? $reservation->end_time : old('end_time') }}" required>
            </div>

            <!-- Locatie -->
            <div>
                <label for="place" class="block text-gray-700">Locatie:</label>
                <input type="text" id="place" name="place" class="w-full border border-gray-300 rounded p-2"
                    value="{{ isset($reservation) ? $reservation->place : old('place') }}" required>
            </div>

            <!-- Beschrijving -->
            <div>
                <label for="description" class="block text-gray-700">Beschrijving:</label>
                <textarea id="description" name="description" class="w-full border border-gray-300 rounded p-2">{{ isset($reservation) ? $reservation->description : old('description') }}</textarea>
            </div>

            <!-- Opslaan knop -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    {{ isset($reservation) ? 'Bijwerken' : 'Opslaan' }}
                </button>
            </div>
        </form>
    </div>

@endsection
