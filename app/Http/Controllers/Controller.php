<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Sends a success response in JSON format.
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */

    public static function sendSuccessResponse(mixed $data, string $message = '', int $code = 200)
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }


        /**
     * Send an error response in JSON format.
     *
     * @param string $message
     * @param mixed $errors
     * @param int $code
     * @return JsonResponse
     */
    public static function sendErrorResponse(string $message, mixed $errors = null, int $code = 500)
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
