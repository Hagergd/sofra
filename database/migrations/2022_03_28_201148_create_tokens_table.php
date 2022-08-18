<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('token', 100);
			$table->string('api_token', 100);
			$table->enum('platform', array('android', 'ios'));
			$table->integer('clientable_id')->unsigned();
			$table->string('clientable_type');
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}