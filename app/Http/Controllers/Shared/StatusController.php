<?php
namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    /**
     * Wijzig de status van een record.
     */
    public function updateStatus(Request $request, $model, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:active,inactive',
        ]);

        if (!class_exists($model)) {
            return response()->json(['message' => 'Model not found'], 404);
        }

        $record = app($model)->find($id);

        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $record->update(['status' => $validated['status']]);

        return response()->json(['message' => 'Status updated successfully', 'data' => $record]);
    }
}
