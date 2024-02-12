<?php

declare(strict_types=1);

namespace App\Menus\ExistingCustomer\Susu\MySusuAccounts\SusuAccount\SusuCloseAccount;

use App\Common\ResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

final class SusuCloseAccountMenu
{
    public static function mainMenu($session): JsonResponse
    {
        // Return the account main menu
        return ResponseBuilder::infoResponseBuilder(
            message: 'Close Account features coming soon',
            session_id: $session->session_id,
        );
    }
}