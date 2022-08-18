<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMealOrderTable extends Migration {

	public function up()
	{
		Schema::create('meal_order', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('order_id')->unsigned();
			$table->integer('meal_id')->unsigned();
			$table->integer('quantity');
			$table->text('special_order');
			$table->decimal('price');
		});
	}

	public function down()
	{
		Schema::drop('meal_order');
	}
}