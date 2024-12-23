<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timeSlots = ['09:00', '10:00', '11:00', '13:00', '14:00', '15:00'];
        return view('reservation', compact('timeSlots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservation/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
        ]);
    
        Reservation::create([
            'date' => $request->date,
            'time' => $request->time,
            'user_id' => auth()->id(), // Assuming reservations are tied to users
        ]);
    
        return redirect()->route('reserveren.index')->with('status', 'Reservering succesvol aangemaakt!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
