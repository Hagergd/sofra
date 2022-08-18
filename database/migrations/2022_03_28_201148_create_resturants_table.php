<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResturantsTable extends Migration {

	public function up()
	{
		Schema::create('resturants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 60);
			$table->string('phone', 60);
			$table->string('whats_phone', 60);
			$table->string('image', 60);
			$table->text('about_resturant');
			$table->integer('region_id')->unsigned();
			$table->decimal('lowest_price');
			$table->string('email', 100);
			$table->decimal('delivery_price');
			$table->string('password', 60);
			$table->string('api_token', 100)->default('12345tghjkmb');
			$table->integer('pin_code');
			$table->enum('status', array('on', 'off'));
			$table->decimal('commission');
		});
	}

	public function down()
	{
		Schema::drop('resturants');
	}
}