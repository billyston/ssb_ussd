<?php

declare(strict_types=1);

namespace Domain\Customer\Actions\ExistingCustomer\Susu\CreateNewSusu\BizSusu;

use App\Menus\ExistingCustomer\Susu\CreateNewSusu\BizSusu\CreateBizSusuMenu;
use App\Menus\Shared\GeneralMenu;
use App\Services\Susu\Requests\BizSusu\CreateBizSusu;
use Domain\Customer\Actions\Common\GetCustomerAction;
use Domain\Customer\Actions\ExistingCustomer\Common\CustomerLinkedWalletsAction;
use Domain\Shared\Action\SessionInputUpdateAction;
use Domain\Shared\Models\Session;
use Domain\Susu\Data\BizSusuData;
use Symfony\Component\HttpFoundation\JsonResponse;

final class LinkedWalletAction
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        // Execute the LinkedWalletAction
        if (! CustomerLinkedWalletsAction::execute(session: $session, session_data: $session_data)) {
            return GeneralMenu::invalidInput(session: $session);
        }

        // Get the customer
        $customer = GetCustomerAction::execute($session->phone_number);

        // Execute the CreateBizSusu HTTP request
        $susu_created = (new CreateBizSusu)->createBizSusu(customer: $customer, data: BizSusuData::toArray(json_decode($session->user_inputs, associative: true)));

        // Return a success response
        if (data_get($susu_created, key: 'status') === true) {
            // Update the user_data with the new susu_created resource
            SessionInputUpdateAction::data(session: $session, user_data: ['susu_resource' => data_get($susu_created, key: 'data.resource_id')]);

            // Return the confirmTermsConditionsMenu
            return CreateBizSusuMenu::narrationMenu(session: $session, susu_data: data_get($susu_created, key: 'data.attributes'));
        }

        // Return system error menu
        return GeneralMenu::invalidInput(session: $session);
    }
}
