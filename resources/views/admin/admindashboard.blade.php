@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-6 text-center">Geplande Afspraken</h1>

        <!-- Filters -->
        <div class="flex justify-center gap-4 mb-6">
            <button
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none"
                onclick="filterAppointments('day')"
            >
                Dag
            </button>
            <button
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none"
                onclick="filterAppointments('week')"
            >
                Week
            </button>
            <button
                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 focus:outline-none"
                onclick="filterAppointments('month')"
            >
                Maand
            </button>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg dark:bg-gray-800">
            <table class="w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">Datum</th>
                        <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">Tijd</th>
                        <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">Plaats</th>
                        <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">Beschrijving</th>
                    </tr>
                </thead>
                <tbody id="appointments-table">
                    @foreach ($appointments as $appointment)
                    <tr class="border-t border-gray-200 dark:border-gray-600">
                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">
                            {{ $appointment->start_time->format('Y-m-d') }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">
                            {{ $appointment->start_time->format('H:i') }} - {{ $appointment->end_time->format('H:i') }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">
                            {{ $appointment->place }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">
                            {{ $appointment->description ?? 'Geen beschrijving' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>