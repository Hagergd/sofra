<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->enum('status', array('pending', 'accepted', 'rejected', 'deliverd', 'declined'));
			$table->text('address');
			$table->string('image', 200)->default('123.jpg');
			$table->enum('payment_method', array('cash', 'online'));
			$table->decimal('order_price')->default('0');
			$table->decimal('delivery_price')->default('0');
			$table->decimal('total_price')->default('0');
			$table->decimal('commission')->default('0');
			$table->integer('client_id')->unsigned();
			$table->integer('resturant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}