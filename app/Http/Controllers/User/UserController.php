<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use App\Models\User; // Import User model
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Haal de gegevens van de ingelogde gebruiker op.
     */
    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Haal de ingelogde gebruiker op

        if (!$user) {
            return response()->json(['message' => 'No authenticated user found'], 401);
        }

        return response()->json([
            'message' => 'User details retrieved successfully',
            'data' => $user,
        ]);
    }

    /**
     * Update het profiel van de ingelogde gebruiker.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Haal de ingelogde gebruiker op

        if (!$user) {
            return response()->json(['message' => 'No authenticated user found'], 401);
        }

        // Validatie
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
        ]);

        // Update profiel met mass assignment
        $user->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $user,
        ]);
    }

    /**
     * Haal alle reserveringen van de ingelogde gebruiker op.
     */
    public function reservations()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Haal de ingelogde gebruiker op

        if (!$user) {
            return response()->json(['message' => 'No authenticated user found'], 401);
        }

        // Haal reserveringen van de gebruiker op via de relatie
        $reservations = $user->reservations;

        return response()->json([
            'message' => 'User reservations retrieved successfully',
            'data' => $reservations,
        ]);
    }
}
