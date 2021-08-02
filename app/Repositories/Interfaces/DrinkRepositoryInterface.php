<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface DrinkRepositoryInterface
{
    public function getEnabledDrinks(): ?Collection;
}