<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log; // Importeer Log Facade

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Formatteer een uniforme JSON-response.
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse($data, $message = 'Success', $status = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Formatteer een JSON-error response.
     *
     * @param string $message
     * @param int $status
     * @param string|null $errorDetails
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonError($message, $status = 400, $errorDetails = null)
    {
        return response()->json([
            'message' => $message,
            'error' => $errorDetails,
        ], $status);
    }

    /**
     * Log een foutmelding en geef een uniforme JSON-error terug.
     *
     * @param \Throwable $exception
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handleError(\Throwable $exception, $message = 'An error occurred', $status = 500)
    {
        $this->logError($exception);

        return $this->jsonError($message, $status, config('app.debug') ? $exception->getMessage() : null);
    }

    /**
     * Log een foutmelding.
     *
     * @param \Throwable $exception
     * @return void
     */
    protected function logError(\Throwable $exception)
    {
        Log::error($exception->getMessage(), [
            'trace' => $exception->getTraceAsString(),
        ]);
    }

    /**
     * Controleer of een actie geautoriseerd is.
     *
     * @param string $ability
     * @param mixed $arguments
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function authorizeAction(string $ability, $arguments = [])
    {
        $this->authorize($ability, $arguments);
    }
}
