<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleryshops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->integer('shopid')->unsigned();
			$table->string('logo', 255)->nullable();
            $table->timestamps();
			$table->unique(array('name', 'shopid'));
        });
		
		
		Schema::table('galleryshops', function($table) {
      		$table->foreign('shopid')->references('id')->on('shopers')->onDelete('cascade');
   		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleryshops');
    }
}
