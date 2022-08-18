<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealsTable extends Migration {

	public function up()
	{
		Schema::create('meals', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('meal_name', 60);
			$table->string('description', 255);
			$table->decimal('price');
			$table->decimal('offer_price');
			$table->string('image', 100);
			$table->decimal('prepare_time');
			$table->integer('category_id')->unsigned();
			$table->integer('resturant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('meals');
	}
}