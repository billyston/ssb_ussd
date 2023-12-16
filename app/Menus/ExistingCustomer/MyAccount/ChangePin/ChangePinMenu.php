<?php

declare(strict_types=1);

namespace App\Menus\ExistingCustomer\MyAccount\ChangePin;

use App\Common\ResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ChangePinMenu
{
    public static function main($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "https://cursorinnovations.site/susubox/policies/terms-and-conditions\n#. Next",
            session_id: data_get(target: $session, key: 'session_id'),
        );
    }

    public static function enterCurrentPin($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: 'Enter your current pin.',
            session_id: data_get(target: $session, key: 'session_id'),
        );
    }

    public static function enterNewPin($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: 'Enter your new pin.',
            session_id: data_get(target: $session, key: 'session_id'),
        );
    }

    public static function confirmNewPin($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: 'Confirm your new pin.',
            session_id: data_get(target: $session, key: 'session_id'),
        );
    }

    public static function successful($session): JsonResponse
    {
        return ResponseBuilder::infoResponseBuilder(
            message: 'You have successfully changed your susubox pin.',
            session_id: data_get(target: $session, key: 'session_id'),
        );
    }
}