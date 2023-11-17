<?php

declare(strict_types=1);

namespace Domain\Customer\Actions\Registration;

use App\Menus\Registration\RegistrationMenu;
use App\Menus\Shared\GeneralMenu;
use Domain\Customer\Models\Customer;
use Domain\Shared\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CustomerUpdateFirstNameAction
{
    public static function execute(
        Customer $customer,
        Session $session,
        Request $request
    ): JsonResponse {
        // Validate the first_name input
        $validator = Validator::make($request->all(), ['Message' => ['required', 'alpha', 'between:2,20']]);

        // Terminate the session if validation failed
        if (! $validator->fails()) {
            // Update the customer record with the first_name
            $customer->update(['first_name' => data_get(target: $request, key: 'Message')]);

            // Return the last name prompt to the customer
            return RegistrationMenu::lastName(data_get(target: $session, key: 'session_id'));
        }

        // Terminate the session
        return GeneralMenu::invalidInput(data_get(target: $session, key: 'session_id'));
    }
}
