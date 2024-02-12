<?php

declare(strict_types=1);

namespace App\Menus\Shared\AboutSusubox;

use App\Common\ResponseBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AboutSusuboxMenu
{
    public static function mainMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "https://susubox.app/about-susubox\n#. Next or 0. Main menu",
            session_id: $session->session_id,
        );
    }

    public static function invalidInputMenu($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "Invalid choice, try again.\n#. Next or 0. Main menu",
            session_id: $session->session_id,
        );
    }

    public static function aboutOne($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "1. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been.\n#. Next or 0. Main menu",
            session_id: $session->session_id,
        );
    }

    public static function aboutTwo($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "2. When an unknown printer took a galley of type and scrambled it to make a type specimen book.\n#. Next or 0. Main menu",
            session_id: $session->session_id,
        );
    }

    public static function aboutThree($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "3. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum.\n#. Next or 0. Main menu",
            session_id: $session->session_id,
        );
    }

    public static function aboutLast($session): JsonResponse
    {
        return ResponseBuilder::ussdResourcesResponseBuilder(
            message: "4. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece.\n#. Cancel or 0. Main menu",
            session_id: $session->session_id,
        );
    }
}