<?php

declare(strict_types=1);

namespace App\Services\Customer\Requests;

use App\Services\Customer\CustomerService;
use Domain\Shared\Models\Customer\Customer;
use Illuminate\Support\Facades\Http;

final class LinkNewAccountApprovalRequest
{
    public CustomerService $service;

    public function __construct()
    {
        $this->service = new CustomerService;
    }

    public function execute(Customer $customer, array $data): array
    {
        return Http::withHeaders(['Content-Type' => 'application/vnd.api+json', 'Accept' => 'application/vnd.api+json'])->post(
            url: $this->service->base_url.$customer->resource_id.'/linked-accounts/approval',
            data: $data,
        )->json();
    }
}