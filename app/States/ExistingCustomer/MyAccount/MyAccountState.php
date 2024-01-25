<?php

declare(strict_types=1);

namespace App\States\ExistingCustomer\MyAccount;

use App\Menus\ExistingCustomer\ExistingCustomerMenu;
use App\Menus\ExistingCustomer\MyAccount\ChangePin\ChangePinMenu;
use App\Menus\ExistingCustomer\MyAccount\LinkedWallets\LinkedWalletsMenu;
use App\Menus\ExistingCustomer\MyAccount\LinkKyc\LinkKycMenu;
use App\Menus\ExistingCustomer\MyAccount\LinkNewWallet\LinkNewWalletMenu;
use App\Menus\ExistingCustomer\MyAccount\MyAccountMenu;
use App\States\ExistingCustomer\ExistingCustomerState;
use App\States\ExistingCustomer\MyAccount\ChangePin\ChangePinState;
use App\States\ExistingCustomer\MyAccount\LinkedWallets\LinkedWalletsState;
use App\States\ExistingCustomer\MyAccount\LinkKyc\LinkKycState;
use App\States\ExistingCustomer\MyAccount\LinkNewWallet\LinkNewWalletState;
use Domain\Shared\Action\Session\SessionUpdateAction;
use Domain\Shared\Models\Session\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class MyAccountState
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        // Define a mapping between customer input and states
        $stateMappings = [
            '1' => ['class' => new LinkedWalletsState, 'menu' => new LinkedWalletsMenu],
            '2' => ['class' => new LinkNewWalletState, 'menu' => new LinkNewWalletMenu],
            '3' => ['class' => new LinkKycState, 'menu' => new LinkKycMenu],
            '4' => ['class' => new ChangePinState, 'menu' => new ChangePinMenu],
            '0' => ['class' => new ExistingCustomerState, 'menu' => new ExistingCustomerMenu],
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

        // Return the MyAccountMenu(invalidMainMenu)
        return MyAccountMenu::invalidMainMenu(session: $session);
    }
}
