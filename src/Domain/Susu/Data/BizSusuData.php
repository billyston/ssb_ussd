<?php

declare(strict_types=1);

namespace Domain\Susu\Data;

final class BizSusuData
{
    public static function toArray(array $user_inputs): array
    {
        return [
            'data' => [
                // Resource type and id
                'type' => 'BizSusu',

                // Resource exposed attributes
                'attributes' => [
                    'account_name' => $user_inputs['business_name'],
                    'amount' => $user_inputs['amount'],
                    'frequency' => $user_inputs['frequency'],
                    'wallet_number' => $user_inputs['wallet'],
                    'network' => $user_inputs['network'],
                ],
            ],
        ];
    }
}
