<?php

declare(strict_types=1);

namespace App\States\ExistingCustomer\Loans\GetLoan\PersonalSusuLoan;

use Domain\Shared\Models\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PersonalSusuLoanState
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
    }
}