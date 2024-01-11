<?php

declare(strict_types=1);

namespace Domain\ExistingCustomer\Actions\Susu\MyAccounts\SusuAccount\MakeSusuPayment;

use App\Menus\Shared\GeneralMenu;
use Domain\Shared\Action\Customer\GetCustomerAction;
use Domain\Shared\Models\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ManualSusuPaymentAction
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        // Get the process flow array from the customer session (user inputs)
        $process_flow = json_decode($session->user_inputs, associative: true);

        // Get the customer
        $customer = GetCustomerAction::execute($session->phone_number);

        // Evaluate the process flow and execute the corresponding action
        return match (true) {
            ! array_key_exists(key: 'begin', array: $process_flow) => GetSusuAccountsAction::execute(session: $session, customer: $customer, session_data: $session_data),
            ! array_key_exists(key: 'susu_account', array: $process_flow) => SelectSusuAccountAction::execute(session: $session, customer: $customer, session_data: $session_data),
            default => GeneralMenu::systemErrorNotification(session: $session),
        };
    }
}