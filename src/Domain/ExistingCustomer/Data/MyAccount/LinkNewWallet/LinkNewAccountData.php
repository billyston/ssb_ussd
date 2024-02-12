<?php

declare(strict_types=1);

namespace Domain\ExistingCustomer\Data\MyAccount\LinkNewWallet;

final class LinkNewAccountData
{
    public static function toArray(string $phone_number, string $network_resource): array
    {
        return [
            'data' => [
                // Resource type and id
                'type' => 'LinkedAccount',

                // Resource exposed attributes
                'attributes' => [
                    'account_number' => $phone_number,
                ],

                // Related resources
                'relationships' => [
                    'scheme' => [
                        'attributes' => [
                            'resource_id' => $network_resource,
                        ],
                    ],
                ],
            ],
        ];
    }
}