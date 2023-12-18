<?php

declare(strict_types=1);

namespace App\States\ExistingCustomer;

use App\Menus\ExistingCustomer\Insurance\InsuranceMenu;
use App\Menus\ExistingCustomer\Investment\InvestmentsMenu;
use App\Menus\ExistingCustomer\Loan\LoanMenu;
use App\Menus\ExistingCustomer\MyAccount\MyAccountMenu;
use App\Menus\ExistingCustomer\Susu\SusuSavingsMenu;
use App\Menus\Welcome\WelcomeMenu;
use App\States\ExistingCustomer\Account\MyAccountState;
use App\States\ExistingCustomer\Insurance\InsuranceState;
use App\States\ExistingCustomer\Investments\InvestmentsState;
use App\States\ExistingCustomer\Loans\LoansState;
use App\States\ExistingCustomer\Susu\SusuSavingsState;
use Domain\Shared\Action\SessionUpdateAction;
use Domain\Shared\Models\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ExistingCustomerState
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        // Define a mapping between customer input and states
        $stateMappings = [
            '1' => ['class' => new SusuSavingsState, 'menu' => new SusuSavingsMenu],
            '2' => ['class' => new LoansState, 'menu' => new LoanMenu],
            '3' => ['class' => new InvestmentsState, 'menu' => new InvestmentsMenu],
            '4' => ['class' => new InsuranceState, 'menu' => new InsuranceMenu],
            '5' => ['class' => new MyAccountState, 'menu' => new MyAccountMenu],
        ];

        // Check if the customer input is a valid option
        if (array_key_exists($session_data->user_input, $stateMappings)) {
            // Get the customer option state
            $customer_state = $stateMappings[$session_data->user_input];

            // Update the customer session action
            SessionUpdateAction::execute(session: $session, state: class_basename($customer_state['class']), session_data: $session_data);

            // Execute the state
            return $customer_state['menu']::mainMenu(session: $session);
        }

        // The customer input is invalid
        return WelcomeMenu::existingCustomerInvalidOption(data_get(target: $session, key: 'session_id'));
    }
}
