<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzaStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->integer('size');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('ingredients', function(Blueprint $table){
           $table->increments('id');
           $table->string('name', 20); 
           $table->timestamps();
        });

        Schema::create('pizzas_has_ingredients', function(Blueprint $table){
            $table->increments('id');
            $table->integer('pizza_id')->index()->unsigned();
            $table->integer('ingredient_id')->index()->unsigned();
            $table->decimal('cuantity', 5, 2);
            $table->timestamps();

            $table->foreign('pizza_id')
            ->references('id')
            ->on('pizzas')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('ingredient_id')
            ->references('id')
            ->on('ingredients')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::create('rates', function(Blueprint $table){
            $table->increments('id');
            $table->decimal('price', 5,2);
            $table->date('start');
            $table->date('end');
            $table->integer('pizza_id')->index()->unsigned();
            $table->timestamps();

            $table->foreign('pizza_id')
            ->references('id')
            ->on('pizzas')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::create('orders', function(Blueprint $table){
            $table->increments('id');
            $table->time('hour');
            $table->integer('status');
            $table->integer('rate_id')->index()->unsigned();
            $table->integer('client_id')->index()->unsigned();
            $table->timestamps();

            $table->foreign('rate_id')
            ->references('id')
            ->on('rates')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('rates');
        Schema::dropIfExists('pizzas_has_ingredients');
        Schema::dropIfExists('pizzas');
        Schema::dropIfExists('ingredients');
    }
}
