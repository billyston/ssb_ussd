<?php

declare(strict_types=1);

namespace App\States\ExistingCustomer\Insurance\MyInsuranceAccounts\InsuranceAccount\InsuranceClaims;

use App\Menus\ExistingCustomer\Insurance\InsuranceMenu;
use Domain\Shared\Models\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class InsuranceClaimsState
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        return InsuranceMenu::mainMenu(session: $session);
    }
}