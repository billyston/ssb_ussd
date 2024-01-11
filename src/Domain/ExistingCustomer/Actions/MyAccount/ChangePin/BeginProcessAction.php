<?php

declare(strict_types=1);

namespace Domain\ExistingCustomer\Actions\MyAccount\ChangePin;

use App\Menus\ExistingCustomer\MyAccount\ChangePin\ChangePinMenu;
use Domain\Shared\Action\Session\SessionInputUpdateAction;
use Domain\Shared\Models\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class BeginProcessAction
{
    public static function execute(Session $session): JsonResponse
    {
        // Update the user inputs (steps)
        SessionInputUpdateAction::updateUserInputs(session: $session, user_input: ['begin' => true]);

        // Return the enterCurrentPin
        return ChangePinMenu::enterCurrentPin(session: $session);
    }
}