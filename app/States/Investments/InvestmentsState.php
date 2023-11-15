<?php

declare(strict_types=1);

namespace App\States\Investments;

use App\Menus\Shared\GeneralMenu;
use Domain\Shared\Models\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

final class InvestmentsState
{
    public static function execute(
        Session $session,
        Request $request,
    ): JsonResponse {
        // Terminate the session
        return GeneralMenu::infoNotification(
            message: 'Dear valued customer, susu investment is coming soon. Watch out this space for more exciting services.',
            session: data_get(target: $session, key: 'session_id'),
        );
    }
}