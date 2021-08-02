<?php

namespace Tests\Feature;

use Tests\TestCase;

class DrinksFeatureTest extends TestCase
{
    public function testGetDrinks()
    {
        $response = $this->get('/api/v1/drinks');
        $expectedResponse = [
                0 => [
                    'id' => 1,
                    'name' => 'Monster Ultra Sunrise',
                    'description' => 'A refreshing orange beverage that has 75mg of caffeine per serving. Every can has two servings.',
                    'caffeine_content' => 150,
                    'image' => '/images/monster_ultra_sunrise.jpg',
                ],
                1 => [
                    'id' => 2,
                    'name' => 'Black Coffee',
                    'description' => 'The classic, the average 8oz. serving of black coffee has 95mg of caffeine.',
                    'caffeine_content' => 95,
                    'image' => '/images/black_coffee.jpg',
                ],
                2 => [
                    'id' => 3,
                    'name' => 'Americano',
                    'description' => 'Sometimes you need to water it down a bit... and in comes the americano with an average of 77mg. of caffeine per serving',
                    'caffeine_content' => 77,
                    'image' => '/images/americano.jpg',
                ],
                3 => [
                    'id' => 4,
                    'name' => 'Sugar free NOS',
                    'description' => 'Another orange delight without the sugar. It has 130 mg. per serving and each can has two servings.',
                    'caffeine_content' => 260,
                    'image' => '/images/sugar_free_nos.jpg',
                ],
                4 => [
                    'id' => 5,
                    'name' => '5 Hour Energy',
                    'description' => 'And amazing shot of get up and go! Each 2 fl. oz. container has 200mg of caffeine to get you going.',
                    'caffeine_content' => 200,
                    'image' => '/images/5_hour_energy.jpg',
                ],
        ];

        $response->assertStatus(200)
            ->assertJson($expectedResponse);
    }

    public function testSearchDrinks()
    {
        $searchValue = 'america';
        $expectedResponse = [ 
            0 => [
                'caffeine_content' => 77,
                'description' => "Sometimes you need to water it down a bit... and in comes the americano with an average of 77mg. of caffeine per serving",
                'id' => 3,
                'image' => "/images/americano.jpg",
                'name' => "Americano"
            ]
        ];


        $response = $this->post('/api/v1/drinks/search', ['search_value' => $searchValue]);

        $response->assertStatus(200)
            ->assertJson($expectedResponse);
    }

    public function testOurAwesomeFiveDrinksExist()
    {
        $this->assertDatabaseCount('drinks', 5);
    }
}
