@extends('layouts.app')

@section('content')
<div class="flex justify-center min-h-screen bg-gray-50 text-[#1D3557] dark:bg-black dark:text-[#607466]">
    <div class="w-full max-w-2xl">
        <div class="rounded-lg shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] bg-white dark:bg-zinc-900 dark:shadow-none p-6">
            <!-- Header -->
            <div class="mb-4">
                <h1 class="text-lg font-semibold text-[#1D3557] dark:text-white">
                    {{ __('Plan je afspraak') }}
                </h1>
                <p class="text-sm text-[#607466] dark:text-gray-400">
                    {{ __('Kies een datum en tijd voor je afspraak.') }}
                </p>
            </div>

            <!-- Formulier -->
            <form method="POST" action="{{ route('reserveren.store') }}">
                @csrf

                <!-- Date Picker -->
                <div class="mb-6">
                    <label for="date" class="block text-sm font-medium text-[#1D3557] dark:text-white">
                        {{ __('Selecteer een datum') }}
                    </label>
                    <input
                        type="date"
                        id="date"
                        name="date"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-[#FF2D20] focus:ring-[#FF2D20]"
                        min="{{ now()->format('Y-m-d') }}"
                        required
                    >
                </div>

                <!-- Time Slots -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-[#1D3557] dark:text-white">
                        {{ __('Selecteer een tijdslot') }}
                    </label>
                    <div id="time-slots" class="grid grid-cols-3 gap-4 mt-2">
                        @foreach ($timeSlots as $timeSlot)
                            <button
                                type="button"
                                class="px-4 py-2 text-sm font-medium text-white bg-[#FF2D20] rounded-md transition hover:bg-[#e0251c] dark:bg-[#607466] dark:hover:bg-[#4b6050]"
                                data-time="{{ $timeSlot }}"
                            >
                                {{ $timeSlot }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Hidden Input for Time -->
                <input type="hidden" name="time" id="selected-time" required>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end">
                    <button
                        type="submit"
                        class="px-4 py-2 text-white bg-[#FF2D20] rounded-md transition hover:bg-[#e0251c] dark:hover:bg-[#ff4733]"
                    >
                        {{ __('Bevestig afspraak') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const timeSlotsContainer = document.getElementById('time-slots');
        const hiddenTimeInput = document.getElementById('selected-time');

        timeSlotsContainer.addEventListener('click', (e) => {
            if (e.target.tagName === 'BUTTON') {
                // Clear previous selections
                timeSlotsContainer.querySelectorAll('button').forEach((btn) => btn.classList.remove('ring-2', 'ring-[#FF2D20]'));

                // Mark selected time
                e.target.classList.add('ring-2', 'ring-[#FF2D20]');
                hiddenTimeInput.value = e.target.getAttribute('data-time');
            }
        });
    });
</script>
@endsection
