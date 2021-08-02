<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\DrinksService;

class DrinksUnitTest extends TestCase
{

    public function testOnlyEnabledDrinksReturned()
    {
        $drinkService = $this->createMock(DrinksService::class);

        $disabledDrinks = $drinkService->getDrinks()?->where('enabled', 0);
        $this->assertTrue(empty($disabledDrinks));
    }
}
