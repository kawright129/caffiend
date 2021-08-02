<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('caffeine_content');
            $table->string('image')->nullable()->default(NULL);
            $table->boolean('enabled')->default(TRUE);
            $table->timestamps();
        });

        DB::table('drinks')->insert([
            [
                'name' => 'Monster Ultra Sunrise',
                'description' => 'A refreshing orange beverage that has 75mg of caffeine per serving. Every can has two servings.',
                'caffeine_content' => 150,
                'image' => '/images/monster_ultra_sunrise.jpg',
            ],
            [
                'name' => 'Black Coffee',
                'description' => 'The classic, the average 8oz. serving of black coffee has 95mg of caffeine.',
                'caffeine_content' => 95,
                'image' => '/images/black_coffee.jpg',
            ],
            [
                'name' => 'Americano',
                'description' => 'Sometimes you need to water it down a bit... and in comes the americano with an average of 77mg. of caffeine per serving',
                'caffeine_content' => 77,
                'image' => '/images/americano.jpg',
            ],
            [
                'name' => 'Sugar free NOS',
                'description' => 'Another orange delight without the sugar. It has 130 mg. per serving and each can has two servings.',
                'caffeine_content' => 260,
                'image' => '/images/sugar_free_nos.jpg',
            ],
            [
                'name' => '5 Hour Energy',
                'description' => 'And amazing shot of get up and go! Each 2 fl. oz. container has 200mg of caffeine to get you going.',
                'caffeine_content' => 200,
                'image' => '/images/5_hour_energy.jpg',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drinks');
    }
}
