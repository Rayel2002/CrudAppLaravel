@extends('layouts.app')

@section('title', 'Mijn Reserveringen')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Mijn Reserveringen</h1>
        @if ($reservations->isEmpty())
            <p>Je hebt nog geen reserveringen gemaakt.</p>
        @else
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="py-2 px-4 border-b">Type</th>
                        <th class="py-2 px-4 border-b">Tijd</th>
                        <th class="py-2 px-4 border-b">Locatie</th>
                        <th class="py-2 px-4 border-b">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $reservation->reservation_type }}</td>
                            <td class="py-2 px-4 border-b">{{ $reservation->start_time }} - {{ $reservation->end_time }}</td>
                            <td class="py-2 px-4 border-b">{{ $reservation->place }}</td>
                            <td class="py-2 px-4 border-b">
                                <form method="POST" action="{{ route('reservations.delete', $reservation) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ route('reservations.new') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Nieuwe Reservering</a>
    </div>
@endsection
