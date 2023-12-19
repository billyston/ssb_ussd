<?php

declare(strict_types=1);

namespace App\Menus\ExistingCustomer\Susu\CreateNewSusu\PersonalSusu;

use App\Common\ResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CreatePersonalSusuMenu
{
    public static function mainMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: 'Enter account name',
            session_id: $session->session_id,
        );
    }

    public static function susuAmountMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: 'Enter susu amount',
            session_id: $session->session_id,
        );
    }

    public static function linkedWalletMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "Choose wallet\n1. 0244294960 - MTN\n2. 0244637602 - Vodafone\n3. 0244294960 - AirtelTigo",
            session_id: $session->session_id,
        );
    }

    public static function accountSummaryMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: 'You are creating a (Account Name) Personal susu savings. GHS10 will be debited daily from your 0244294960 mobile money wallet. Enter pin to confirm or 2 to Cancel.',
            session_id: $session->session_id,
        );
    }
}