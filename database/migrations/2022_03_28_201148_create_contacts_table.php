<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 60);
			$table->string('email', 150);
			$table->string('phone', 60);
			$table->text('message');
			$table->enum('message_type', array('complaint', 'suggestion', 'enquiry'));
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}