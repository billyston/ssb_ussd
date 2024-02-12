<?php

declare(strict_types=1);

namespace App\States\ExistingCustomer\Loans\MyLoanAccounts\LoanAccount\LoanBalance;

use App\Menus\ExistingCustomer\Loan\LoanBalance\LoanBalanceMenu;
use Domain\Shared\Models\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class LoanBalanceState
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        return LoanBalanceMenu::mainMenu(session: $session);
    }
}