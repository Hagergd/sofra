<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 60);
			$table->string('email', 60);
			$table->string('phone', 60);
			$table->string('password', 60);
			$table->integer('pin_code');
			$table->string('api_token', 60)->default('1234fghj76');
			$table->boolean('is_active')->default(1);
			$table->integer('region_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}