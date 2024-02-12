<?php

declare(strict_types=1);

namespace App\States\ExistingCustomer\Pension\CreatePension;

use Domain\Shared\Models\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CreatePensionState
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
    }
}