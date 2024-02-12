<?php

declare(strict_types=1);

namespace App\Menus\ExistingCustomer\Pension\PensionTerms;

use App\Common\ResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PensionTermsMenu
{
    public static function mainMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "Pensions\nContents coming soon.\n0. Back",
            session_id: $session->session_id,
        );
    }

    public static function invalidMainMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "Invalid choice, try again.\nContents coming soon.\n0. Back",
            session_id: $session->session_id,
        );
    }
}