<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        // Alleen toegankelijk voor ingelogde gebruikers
        $this->middleware('auth');
    }

    /**
     * Toon een lijst van reserveringen.
     */
    public function list()
    {
        $user = Auth::user(); // Haal de ingelogde gebruiker op
        $reservations = $user->reservations; // Haal reserveringen van de gebruiker op

        return view('reservation.list', compact('reservations'));
    }

    /**
     * Toon het formulier om een nieuwe reservering aan te maken.
     */
    public function new()
    {
        return view('reservation.new');
    }

    /**
     * Sla een nieuwe reservering op in de database.
     */
    public function save(Request $request)
    {
        $user = Auth::user(); // Haal de ingelogde gebruiker op

        $validated = $request->validate([
            'reservation_type' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'place' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $user->reservations()->create($validated); // Reservering aanmaken

        return redirect()->route('reservation.list')->with('success', 'Reservering succesvol aangemaakt!');
    }

    /**
     * Verwijder een bestaande reservering.
     */
    public function delete(Reservation $reservation)
    {
        $user = Auth::user();

        if ($reservation->created_by !== $user->id) {
            abort(403, 'Je hebt geen toegang om deze reservering te verwijderen.');
        }

        $reservation->delete();

        return redirect()->route('reservation.list')->with('success', 'Reservering succesvol verwijderd!');
    }
}
