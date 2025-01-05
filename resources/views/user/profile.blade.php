@extends('layouts.app')

@section('title', 'Profiel')

@section('content')
<x-card title="Mijn Profiel">
    <form method="POST" action="{{ route('user.updateProfile') }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Naam:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">E-mail:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded p-2">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Opslaan</button>
    </form>
</x-card>
@endsection
