<?php
namespace App\Http\Controllers\Shared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Zoek en filter resultaten.
     */
    public function search(Request $request, $model)
    {
        $validated = $request->validate([
            'query' => 'required|string|max:255',
        ]);

        if (!class_exists($model)) {
            return response()->json(['message' => 'Model not found'], 404);
        }

        $modelInstance = app($model);

        $results = $modelInstance::query()
            ->where(function ($query) use ($validated, $modelInstance) {
                foreach ($modelInstance->searchableFields() as $field) {
                    $query->orWhere($field, 'LIKE', '%' . $validated['query'] . '%');
                }
            })
            ->get();

        return response()->json(['data' => $results, 'message' => 'Search results']);
    }
}
