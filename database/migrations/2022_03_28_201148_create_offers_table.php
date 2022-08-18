<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 60);
			$table->text('description');
			$table->string('image', 100);
			$table->date('from');
			$table->date('to');
			$table->integer('resturant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}