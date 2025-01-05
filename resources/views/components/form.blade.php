@extends('layouts.app')

@section('title', 'Nieuwe Reservering')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Nieuwe Reservering</h1>
        <form action="{{ route('reservations.save') }}" method="POST" class="bg-white p-6 shadow-md rounded-lg">
            @csrf
            <div class="mb-4">
                <label for="type_Id" class="block text-gray-700">Type Reservering:</label>
                <select id="type_Id" name="type_Id" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="" disabled selected>Kies een type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->type_Id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            
        
            <div class="mb-4">
                <label for="start_time" class="block text-gray-700">Start Tijd:</label>
                <input type="time" id="start_time" name="start_time" class="w-full border border-gray-300 rounded p-2" required>
            </div>
        
            <div class="mb-4">
                <label for="end_time" class="block text-gray-700">Eind Tijd:</label>
                <input type="time" id="end_time" name="end_time" class="w-full border border-gray-300 rounded p-2" required>
            </div>
        
            <div class="mb-4">
                <label for="place" class="block text-gray-700">Locatie:</label>
                <input type="text" id="place" name="place" class="w-full border border-gray-300 rounded p-2" required>
            </div>
        
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Beschrijving:</label>
                <textarea id="description" name="description" class="w-full border border-gray-300 rounded p-2"></textarea>
            </div>
        
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Opslaan</button>
        </form>
        

    </div>
@endsection
