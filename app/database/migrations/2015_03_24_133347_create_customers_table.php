<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id')->integer();
                        $table->string('email', 255)->unique();
                        $table->string('first_name', 30);
                        $table->string('last_name', 50);
                        $table->string('ip', 15);
                        $table->float('latitude', 10, 6);
                        $table->float('longitude', 10, 6);
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
		Schema::drop('customers');
	}

}
