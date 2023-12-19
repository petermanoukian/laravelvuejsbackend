<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->integer('catid')->unsigned();
			$table->integer('subid')->unsigned()->nullable();
			$table->integer('prix')->unsigned()->nullable();
			$table->text('description')->nullable();
			$table->string('logo', 255)->nullable();
            $table->timestamps();
        });
		
		
		Schema::table('shopers', function($table) {
      		$table->foreign('catid')->references('id')->on('shopcats')->onDelete('cascade');
   		});
		
		Schema::table('shopers', function($table) {
      		$table->foreign('subid')->references('id')->on('shopcats')->onDelete('cascade');
   		});
	
		
		
    }
	

	

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopers');
    }
}
