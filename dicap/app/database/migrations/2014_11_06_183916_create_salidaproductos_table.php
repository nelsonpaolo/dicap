<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidaproductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('salidaproductos', function($table) {
			$table->create();
			$table->integer('idsalida');
			$table->integer('idproducto');
			$table->integer('idlugar');
			$table->float('precio_venta');
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
		Schema::drop('salidaproductos');
	}

}
