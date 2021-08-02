<?php

namespace App\Repositories;

use App\Repositories\Interfaces\DrinkRepositoryInterface;
use App\Models\Drink;
use Illuminate\Support\Collection;

class DrinkRepository implements DrinkRepositoryInterface
{
    public function getEnabledDrinks(string $searchValue = ""): ?Collection
    {
        $drinks = Drink::where('enabled', 1);
        
        if(!empty($searchValue)) {
            $drinks->where('name', 'like', "%{$searchValue}%");
        }

        return $drinks->get();
    }

}
