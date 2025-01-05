<?php
namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    /**
     * Upload een bestand naar de server.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf', // Beperk bestandstypen en grootte
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        return $this->jsonResponse(['path' => $path], 'File uploaded successfully');
    }
}
