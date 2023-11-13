<?php

declare(strict_types=1);

namespace App\Common;

use Illuminate\Http\JsonResponse;

final class ResponseBuilder
{
    public static function ussdResourcesResponseBuilder(
        string $message,
        string $session_id,
    ): JsonResponse {
        return response()->json([
            'Type' => 'response',
            'SessionId' => $session_id,
            'Message' => $message,
            'DataType' => 'input',
            'FieldType' => 'text'
        ]);
    }

    public static function invalidResponseBuilder(
        string $message,
        string $session_id,
    ): JsonResponse {
        return response()->json([
            'Type' => 'release',
            'SessionId' => $session_id,
            'Message' => $message,
        ]);
    }

    public static function terminateResponseBuilder(
        string $session_id,
    ): JsonResponse {
        return response()->json([
            'Type' => 'release',
            'SessionId' => $session_id,
            'Message' => 'Thank you for using ssb. See you soon.',
        ]);
    }
}
