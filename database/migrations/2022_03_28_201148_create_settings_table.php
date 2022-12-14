<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('about_app');
			$table->string('phone', 60);
			$table->string('email', 60);
			$table->decimal('commission');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}