@extends('layouts.app')

@section('title', 'Mijn Reserveringen')

@section('content')
<x-card title="Mijn Reserveringen">
    <div class="flex justify-between items-center mb-4">
        <p class="text-gray-600">Bekijk je huidige reserveringen hieronder.</p>
        <a href="{{ route('reservations.new') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
            Nieuwe Reservering
        </a>
    </div>

    @if ($reservations->isEmpty())
        <p>Je hebt nog geen reserveringen gemaakt.</p>
    @else
        <x-table>
            <x-slot:head>
                <th class="py-2 px-4 border-b text-center">Type</th>
                <th class="py-2 px-4 border-b text-center">Categorie</th>
                <th class="py-2 px-4 border-b text-center">Start Tijd</th>
                <th class="py-2 px-4 border-b text-center">Eind Tijd</th>
                <th class="py-2 px-4 border-b text-center">Acties</th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $reservation->type->name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $reservation->category->name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $reservation->start_time }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $reservation->end_time }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            <a href="{{ route('reservations.show', $reservation->reservation_Id) }}" class="text-blue-500 hover:underline" title="Bekijk Details">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="{{ route('reservations.edit', $reservation->reservation_Id) }}" class="text-yellow-500 hover:underline ml-2" title="Bewerk Reservering">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('reservations.delete', $reservation->reservation_Id) }}" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-2" title="Verwijder Reservering">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>
    @endif
</x-card>
@endsection
