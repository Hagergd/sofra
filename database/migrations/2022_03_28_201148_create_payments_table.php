<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->decimal('paid_amount');
			$table->decimal('remaining_amount');
			$table->text('commission_text');
			$table->integer('resturant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}