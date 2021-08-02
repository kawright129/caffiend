<?php

namespace App\Services;

use App\Repositories\Interfaces\DrinkRepositoryInterface;

class DrinksService
{

    public function __construct(protected DrinkRepositoryInterface $drinkRepository){ }


    public function getDrinks(string $searchValue = "")
    {
        return $this->drinkRepository->getEnabledDrinks($searchValue);
    }
}