<?php

use App\Models\Client;
use App\Models\Ingredient;
use App\Models\Orders;
use App\Models\Pizza;
use App\Models\PizzaHasIngredient;
use App\Models\Rates;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = factory(Ingredient::class, 15)->create();

        factory(Pizza::class, 10)->create()
            ->each(function($pizza) use ($ingredients){
            
                factory(PizzaHasIngredient::class, 3)->create([

                    'pizza_id' => $pizza->id,
                    'ingredient_id' => $ingredients[rand(0,14)]->id
                
                    ]);

                $rates = factory(Rates::class, 2)->create([
                    'pizza_id' => $pizza->id
                ]);

                factory(Client::class, 2)->create()
                    ->each(function($client) use($rates){

                        factory(Orders::class, 5)->create([

                            'client_id' => $client->id,
                            'rate_id' => $rates[rand(0,1)]->id

                        ]);
                    });

                
        });
    }
}
