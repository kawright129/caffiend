<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewSearchRequest;
use App\Services\DrinksService;

class DrinksController extends Controller
{

    public function __construct(protected DrinksService $drinksService) {}

    public function index(NewSearchRequest $request)
    {
        $validatedInput = $request->validated();
        $searchValue    = $validatedInput['search_value'] ?? '';

        $drinks = $this->drinksService->getDrinks($searchValue);

        return response()->json($drinks);
    }
}
