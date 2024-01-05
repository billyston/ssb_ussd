<?php

declare(strict_types=1);

namespace App\States\ExistingCustomer\Susu\CreateNewSusu\FlexySave;

use App\Menus\Shared\GeneralMenu;
use Domain\Customer\Actions\ExistingCustomer\Susu\CreateNewSusu\FlexySave\AccountNameAction;
use Domain\Customer\Actions\ExistingCustomer\Susu\CreateNewSusu\FlexySave\ConfirmationAction;
use Domain\Customer\Actions\ExistingCustomer\Susu\CreateNewSusu\FlexySave\FrequencyAction;
use Domain\Customer\Actions\ExistingCustomer\Susu\CreateNewSusu\FlexySave\LinkedWalletAction;
use Domain\Customer\Actions\ExistingCustomer\Susu\CreateNewSusu\FlexySave\MaxRangeAction;
use Domain\Customer\Actions\ExistingCustomer\Susu\CreateNewSusu\FlexySave\MinRangeAction;
use Domain\Customer\Actions\ExistingCustomer\Susu\CreateNewSusu\FlexySave\RecurringDebitAction;
use Domain\Shared\Models\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CreateFlexySusuState
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        // Get the process flow array from the customer session (user inputs)
        $process_flow = json_decode($session->user_inputs, associative: true);

        // Evaluate the process flow and execute the corresponding action
        return match (true) {
            ! array_key_exists(key: 'account_name', array: $process_flow) => AccountNameAction::execute(session: $session, session_data: $session_data),
            ! array_key_exists(key: 'min_range', array: $process_flow) => MinRangeAction::execute(session: $session, session_data: $session_data),
            ! array_key_exists(key: 'max_range', array: $process_flow) => MaxRangeAction::execute(session: $session, session_data: $session_data),
            ! array_key_exists(key: 'frequency', array: $process_flow) => FrequencyAction::execute(session: $session, session_data: $session_data),
            ! array_key_exists(key: 'recurring_debit', array: $process_flow) => RecurringDebitAction::execute(session: $session, session_data: $session_data),
            ! array_key_exists(key: 'wallet', array: $process_flow) => LinkedWalletAction::execute(session: $session, session_data: $session_data),
            ! array_key_exists(key: 'confirmation', array: $process_flow) => ConfirmationAction::execute(session: $session, session_data: $session_data),
            default => GeneralMenu::systemErrorNotification(session: $session),
        };
    }
}
