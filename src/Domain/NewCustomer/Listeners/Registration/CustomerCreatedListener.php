<?php

namespace Domain\NewCustomer\Listeners\Registration;

use App\Services\Customer\CustomerService;
use App\Services\Mobile\MobileService;
use Domain\NewCustomer\Data\Registration\CustomerData;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;

final class CustomerCreatedListener implements ShouldQueue
{
    /**
     * @throws Exception
     */
    public function handle(object $event): void
    {
        // Define the message data
        $data = CustomerData::toArray(customer: $event->customer);

        // Publish message through http
        (new CustomerService)->storeCustomer($data);
        (new MobileService)->storeCustomer($data);

        // Initialize the RabbitMQService and publish messages
        //        $rabbitMQService = new RabbitMQService;

        // Define the message headers
        //        $headers = ['origin' => 'ussd', 'action' => 'CreateCustomerAction'];

        //        $rabbitMQService->publish(exchange: 'ssb_direct', routingKey: 'ssb_mob', data: $data, headers: $headers);
        //        $rabbitMQService->publish(exchange: 'ssb_direct', routingKey: 'ssb_cus', data: $data, headers: $headers);
    }
}