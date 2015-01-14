<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('productos', function($table) {
			$table->create();
			$table->increments('id');
			$table->string('codigo');
			$table->string('nombre');
			$table->float('precio_compra');
			$table->float('precio_venta');
			$table->integer('marca');
			$table->integer('categoria');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('productos');
	}

}
