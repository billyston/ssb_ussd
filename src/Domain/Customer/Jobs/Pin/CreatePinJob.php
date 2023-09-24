<?php

declare(strict_types=1);

namespace Domain\Customer\Jobs\Pin;

use App\Jobs\Customer\Pin\CreatePinEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class CreatePinJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        private readonly array $request
    ) {
    }

    public function handle(): void
    {
        // Publish a CreatePinEvent
        CreatePinEvent::dispatch(request: $this->request);
    }
}