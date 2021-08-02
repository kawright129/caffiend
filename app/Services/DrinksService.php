<?php

namespace App\Services;

use App\Repositories\Interfaces\DrinkRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DrinksService
{

    public function __construct(protected DrinkRepositoryInterface $drinkRepository){ }


    public function getDrinks(string $searchValue = ""): ?Collection
    {
        return $this->drinkRepository->getEnabledDrinks($searchValue);
    }
}