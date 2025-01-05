<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Haal reserveringen van de ingelogde gebruiker op
        $reservations = Reservation::where('created_by', $user->id)->get();

        return view('reservation.list', compact('reservations'));
    }

    public function show(Reservation $reservation)
    {
        $user = Auth::user();

        // Controleer of de gebruiker toegang heeft tot deze reservering
        if ($reservation->created_by !== $user->id) {
            abort(403, 'Je hebt geen toegang tot deze reservering.');
        }

        return view('reservation.detail', compact('reservation'));
    }

    /**
     * Toon het formulier om een nieuwe reservering aan te maken.
     */
    public function new()
    {
        $types = Type::all(); // Alle beschikbare types ophalen
        return view('reservation.new', compact('types')); // Geef $types door aan de view
    }

    /**
     * Sla een nieuwe reservering op in de database.
     */
    public function save(Request $request)
    {
        $user = Auth::user();

        // Validatie
        $validated = $request->validate([
            'type_Id' => 'required|exists:types,type_Id', // Controleer of type_Id bestaat
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'place' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Haal de gekoppelde category_Id op via het type
        $type = Type::find($validated['type_Id']);
        $category_Id = $type->category_Id;

        if (!$category_Id) {
            return back()->withErrors(['type_Id' => 'Het gekozen type heeft geen gekoppelde categorie.']);
        }

        // Maak de reservering aan
        Reservation::create([
            'type_Id' => $validated['type_Id'], // Zorg dat type_Id wordt meegegeven
            'category_Id' => $category_Id, // Automatisch gekoppeld
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'place' => $validated['place'],
            'description' => $validated['description'],
            'created_by' => $user->id,
            'status_Id' => 1, // Default status
        ]);

        return redirect()->route('reservations.list')->with('success', 'Reservering succesvol aangemaakt!');
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

        return redirect()->route('reservations.list')->with('success', 'Reservering succesvol verwijderd!');
    }
}
