<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleryports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->integer('portid')->unsigned();
			$table->string('logo', 255)->nullable();
            $table->timestamps();
			$table->unique(array('name', 'portid'));
        });
		

		
		Schema::table('galleryports', function($table) {
      		$table->foreign('portid')->references('id')->on('portfolios')->onDelete('cascade');
   		});
		
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleryports');
    }
}
