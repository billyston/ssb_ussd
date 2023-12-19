<?php

declare(strict_types=1);

namespace Domain\Customer\Actions\NewCustomer\Registration;

use Domain\Customer\Models\Customer;

final class CustomerCreateAction
{
    public static function execute(string $phone_number): bool
    {
        // Create the Customer
        $create_customer = Customer::query()->create(['phone_number' => $phone_number]);

        return (bool) $create_customer;
    }
}