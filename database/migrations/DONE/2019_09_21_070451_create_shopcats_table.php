<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopcats', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('catid')->unsigned()->nullable();
			$table->string('name')->unique();
            $table->timestamps();
        });
		
		Schema::table('shopcats', function($table) {
      		$table->foreign('catid')->references('id')->on('shopcats')->onDelete('cascade');
   		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopcats');
    }
}
