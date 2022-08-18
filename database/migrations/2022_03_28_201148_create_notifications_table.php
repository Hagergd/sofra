<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 60);
			$table->timestamps();
			$table->text('content');
			$table->boolean('is_read')->default(0);
			$table->integer('notificationable_id');
			$table->string('notificationable_type');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}