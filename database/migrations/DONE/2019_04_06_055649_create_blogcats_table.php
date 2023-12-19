<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogcats', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('catid')->unsigned()->nullable();
			$table->string('name')->unique();
            $table->timestamps();
        });
		
		Schema::table('blogcats', function($table) {
      		$table->foreign('catid')->references('id')->on('blogcats')->onDelete('cascade');
   		});
		
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogcats');
    }
}
