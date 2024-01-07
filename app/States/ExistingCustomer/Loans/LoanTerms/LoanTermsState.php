<?php

declare(strict_types=1);

namespace App\States\ExistingCustomer\Loans\LoanTerms;

use App\Menus\ExistingCustomer\Loan\LoanTerms\LoanTermsMenu;
use Domain\Shared\Models\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class LoanTermsState
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        return LoanTermsMenu::mainMenu(session: $session);
    }
}