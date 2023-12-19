<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicesubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->integer('servid')->unsigned();
			$table->string('logo', 255)->nullable();
            $table->timestamps();
			$table->unique(array('name', 'servid'));
        });
		
		Schema::table('servicesubs', function($table) {
      		$table->foreign('servid')->references('id')->on('services')->onDelete('cascade');
   		});
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicesubs');
    }
}
