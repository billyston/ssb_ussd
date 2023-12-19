<?php

declare(strict_types=1);

namespace App\States\NewCustomer\AboutSusubox;

use App\Menus\NewCustomer\AboutSusubox\AboutSusuboxMenu;
use Domain\Shared\Action\SessionInputUpdateAction;
use Domain\Shared\Models\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AboutSusuboxState
{
    public static function execute(Session $session, $session_data): JsonResponse
    {
        // Get the process flow array from the customer session (user inputs)
        $process_flow = json_decode($session->user_inputs, associative: true);

        // Validate inputs and update the session input
        return match (true) {
            ! array_key_exists('aboutSusuboxOne', $process_flow) => self::updateAndReturnMenu($session, 'aboutSusuboxOne', AboutSusuboxMenu::mainMenu(session: $session)),
            ! array_key_exists('aboutSusuboxTwo', $process_flow) => self::updateAndReturnMenu($session, 'aboutSusuboxTwo', AboutSusuboxMenu::aboutSusuboxOne(session: $session)),
            ! array_key_exists('aboutSusuboxThree', $process_flow) => self::updateAndReturnMenu($session, 'aboutSusuboxThree', AboutSusuboxMenu::aboutSusuboxTwo(session: $session)),
            ! array_key_exists('aboutSusuboxLast', $process_flow) => self::updateAndReturnMenu($session, 'aboutSusuboxLast', AboutSusuboxMenu::aboutSusuboxThree(session: $session)),
            ! array_key_exists('end', $process_flow) => self::updateAndReturnMenu($session, 'end', AboutSusuboxMenu::aboutSusuboxLast(session: $session)),
            default => AboutSusuboxMenu::mainMenu(session: $session),
        };
    }

    private static function updateAndReturnMenu(Session $session, string $key, JsonResponse $menu): JsonResponse
    {
        // Execute the SessionInputUpdateAction
        SessionInputUpdateAction::execute(session: $session, user_input: [$key => true]);

        // Return the menu (Term and Condition)
        return $menu;
    }
}