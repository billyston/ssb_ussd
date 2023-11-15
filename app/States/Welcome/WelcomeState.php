<?php

namespace App\States\Welcome;

use App\Menus\Welcome\WelcomeMenu;
use Domain\Customer\Actions\Common\GetCustomerAction;
use Domain\Shared\Action\SessionUpdateAction;
use Domain\Shared\Models\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class WelcomeState
{
    public static function execute(
        Session $session,
    ): JsonResponse {
        // Get the customer
        $customer = GetCustomerAction::execute(data_get(target: $session, key: 'phone_number'));

        // Customer exist and status is active
        if ($customer && data_get(target: $customer, key: 'status') === 'active') {
            // Update the session's state
            SessionUpdateAction::execute(session: $session, state: 'ExistingCustomerState');

            // Return the existing customer menu
            return WelcomeMenu::existingCustomer(data_get(target: $session, key: 'session_id'));
        }

        // Update the session's state
        SessionUpdateAction::execute(session: $session, state: 'NewCustomerState');

        // Return the new customer menu
        return WelcomeMenu::newCustomer(data_get(target: $session, key: 'session_id'));
    }
}