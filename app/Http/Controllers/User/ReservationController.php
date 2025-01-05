<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 

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
        $types = Type::all();
        $action = route('reservations.save'); // Route voor nieuwe reservering opslaan
        return view('reservation.new', compact('action', 'types'));
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

    public function edit(Reservation $reservation)
    {
        $user = Auth::user();
    
        // Controleer of de gebruiker de eigenaar is van de reservering
        if ($reservation->created_by !== $user->id) {
            abort(403, 'Je hebt geen toegang om deze reservering te bewerken.');
        }
    
        $types = Type::all();
        $action = route('reservations.update', $reservation->reservation_Id); // Route voor bijwerken
        $method = 'PUT';
        $reservation->start_time = substr($reservation->start_time, 0, 5); // Alleen uren en minuten
        $reservation->end_time = substr($reservation->end_time, 0, 5);
        
        return view('reservation.edit', compact('reservation', 'types', 'action', 'method'));
        
    }
    
    public function update(Request $request, Reservation $reservation)
    {
        $user = Auth::user();
    
        try {
            // Controleer of de gebruiker de eigenaar is
            if ($reservation->created_by !== $user->id) {
                Log::warning('Unauthorized update attempt', [
                    'user_id' => $user->id,
                    'reservation_id' => $reservation->reservation_Id,
                ]);
                abort(403, 'Je hebt geen toestemming om deze reservering te bewerken.');
            }
    
            // Validatie
            $validated = $request->validate([
                'type_Id' => 'required|exists:types,type_Id',
                'start_time' => 'required|date_format:H:i', // Controleer op exact H:i-formaat
                'end_time' => 'required|date_format:H:i|after:start_time', // Controleer op H:i-formaat en volgorde
                'place' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);
            
    
            // Log de updatepoging
            Log::info('Updating reservation', [
                'user_id' => $user->id,
                'reservation_id' => $reservation->reservation_Id,
                'data' => $validated,
            ]);
    
            // Bijwerken van de reservering
            $reservation->update($validated);
    
            Log::info('Reservation updated successfully', [
                'user_id' => $user->id,
                'reservation_id' => $reservation->reservation_Id,
            ]);
    
            return redirect()->route('reservations.list')->with('success', 'Reservering succesvol bijgewerkt!');
    
        } catch (\Exception $e) {
            // Log de fout
            Log::error('Error updating reservation', [
                'user_id' => $user->id,
                'reservation_id' => $reservation->reservation_Id,
                'error' => $e->getMessage(),
            ]);
    
            return redirect()->route('reservations.list')->withErrors('Er is een fout opgetreden bij het bijwerken van de reservering.');
        }
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
