<?php

declare(strict_types=1);

namespace Domain\ExistingCustomer\Actions\Susu\MyAccounts\SusuAccount\CheckSusuBalance;

use App\Menus\ExistingCustomer\Susu\MySusuAccounts\SusuAccount\CheckSusuBalance\CheckBalanceMenu;
use App\Menus\Shared\GeneralMenu;
use App\Services\Susu\Requests\Susu\SusuBalance;
use Domain\ExistingCustomer\Data\Common\PinApprovalData;
use Domain\Shared\Action\Session\SessionInputUpdateAction;
use Domain\Shared\Models\Customer\Customer;
use Domain\Shared\Models\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class GetAccountBalanceAction
{
    public static function execute(Session $session, Customer $customer, $session_data): JsonResponse
    {
        // Update the user inputs (steps)
        SessionInputUpdateAction::updateUserInputs(session: $session, user_input: ['confirmation' => true]);

        // Get the process flow array from the customer session (user inputs)
        $process_flow = json_decode($session->user_inputs, associative: true);

        // Execute the createPersonalSusu HTTP request
        $get_balance = (new SusuBalance)->execute(customer: $customer, susu_resource: $process_flow['account_resource'], data: PinApprovalData::toArray($session_data->user_input));

        // Terminate session if $susu_collection request status is false
        if (! data_get(target: $get_balance, key: 'status') === true || data_get(target: $get_balance, key: 'code') !== 200) {
            return GeneralMenu::invalidInput(session: $session);
        }

        // Prepare the and return the susu accounts
        if (! empty(data_get($get_balance, key: 'data'))) {
            return CheckBalanceMenu::susuBalanceMenu(session: $session, susu_data: data_get(target: $get_balance, key: 'data.attributes'));
        }

        // Return the noSususAccount
        return CheckBalanceMenu::noSususAccount(session: $session);
    }
}