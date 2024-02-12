<?php

declare(strict_types=1);

namespace App\Menus\ExistingCustomer\Susu\MySusuAccounts\SusuAccount\SusuPauseAccount;

use App\Common\ResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

final class SusuPauseAccountMenu
{
    public static function mainMenu($session): JsonResponse
    {
        // Return the account main menu
        return ResponseBuilder::infoResponseBuilder(
            message: 'Pause Account features coming soon',
            session_id: $session->session_id,
        );
    }
}