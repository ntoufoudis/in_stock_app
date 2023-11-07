<?php

namespace Tests;

use Facades\App\Clients\ClientFactory;
use App\Clients\StockStatus;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function mockClientRequest($available = true, $price = 29900): void
    {
        ClientFactory::shouldReceive('make->checkAvailability')
            ->andReturn(new StockStatus($available, $price));
    }
}
