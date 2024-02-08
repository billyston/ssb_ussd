<?php

declare(strict_types=1);

namespace App\Menus\ExistingCustomer\Pension\AboutPension;

use App\Common\ResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AboutPensionMenu
{
    public static function mainMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "About Pensions\n1. Pension Schemes\n2. Benefits\n3. Guarantees\n4. Contributions\n5. Payouts\n6. Fees & Charges\n0. Back",
            session_id: $session->session_id,
        );
    }

    public static function invalidMainMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "Invalid choice, try again\n1. Pension Schemes\n2. Benefits\n3. Guarantees\n4. Contributions\n5. Payouts\n6. Fees & Charges\n0. Back",
            session_id: $session->session_id,
        );
    }
}
