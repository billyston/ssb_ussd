<?php

declare(strict_types=1);

namespace Domain\ExistingCustomer\Actions\MyAccount\ChangePin;

use App\Menus\ExistingCustomer\MyAccount\ChangePin\ChangePinMenu;
use App\Menus\Shared\GeneralMenu;
use App\Services\Customer\CustomerService;
use Domain\ExistingCustomer\Data\MyAccount\ChangePin\PinChangeData;
use Domain\Shared\Action\Customer\GetCustomerAction;
use Domain\Shared\Action\Session\SessionInputUpdateAction;
use Domain\Shared\Models\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ConfirmNewPinAction
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        // Validate the user input
        if (! ValidatePinAction::execute($session_data->user_input)) {
            return ChangePinMenu::invalidConfirmNewPin(session: $session);
        }

        // Get the process flow array from the customer session (user inputs)
        $data = json_decode($session->user_inputs, associative: true);

        // Check if new_pin and confirm_new_pin match
        if ($session_data->user_input !== data_get(target: $data, key: 'new_pin')) {
            return ChangePinMenu::invalidConfirmNewPin(session: $session);
        }

        // Get the customer
        $customer = GetCustomerAction::execute($session->phone_number);

        // Update the user inputs (steps)
        SessionInputUpdateAction::updateUserInputs(session: $session, user_input: ['confirm_pin' => $session_data->user_input]);

        // Send change pin request to ssb_customer
        $pin_changed = (new CustomerService)->changePin(customer: $customer, data: PinChangeData::toArray(current_pin: data_get(target: $data, key: 'current_pin'), new_pin: data_get(target: $data, key: 'new_pin')));

        // Terminate session if $susu_collection request status is false
        if (! data_get(target: $pin_changed, key: 'status') === true || data_get(target: $pin_changed, key: 'code') !== 200) {
            return GeneralMenu::invalidInput(session: $session);
        }

        // Prepare the and return the susu accounts
        return ChangePinMenu::successful(session: $session);
    }
}