@extends('layouts.app')

@section('title', 'Mijn Reserveringen')

@section('content')
    <x-card title="Mijn Reserveringen">
        <!-- Nieuwe reservering knop -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('reservations.new') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Nieuwe Reservering
            </a>
        </div>

        @if ($reservations->isEmpty())
            <p>Je hebt nog geen reserveringen gemaakt.</p>
        @else
            <x-table>
                <x-slot:head>
                    <th class="py-2 px-4 border-b">Type</th>
                    <th class="py-2 px-4 border-b">Categorie</th>
                    <th class="py-2 px-4 border-b">Start Tijd</th>
                    <th class="py-2 px-4 border-b">Eind Tijd</th>
                    <th class="py-2 px-4 border-b">Locatie</th>
                    <th class="py-2 px-4 border-b">Beschrijving</th>
                    <th class="py-2 px-4 border-b">Status</th>
                </x-slot:head>
                <x-slot:body>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $reservation->type->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $reservation->category->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $reservation->start_time }}</td>
                            <td class="py-2 px-4 border-b">{{ $reservation->end_time }}</td>
                            <td class="py-2 px-4 border-b">{{ $reservation->place }}</td>
                            <td class="py-2 px-4 border-b">{{ $reservation->description }}</td>
                            <td class="py-2 px-4 border-b">{{ $reservation->status->status }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('reservations.show', $reservation->reservation_Id) }}" class="text-blue-500 hover:underline">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </x-slot:body>
                
            </x-table>
        @endif
    </x-card>
@endsection
