<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

		
		Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->integer('catid')->unsigned();
			$table->integer('subid')->unsigned();
			$table->integer('userid')->unsigned();
			$table->text('description')->nullable();
			$table->string('logo', 255)->nullable();
            $table->timestamps();
        });
		
		Schema::table('blogs', function($table) {
      		$table->foreign('catid')->references('id')->on('blogcats')->onDelete('cascade');
   		});
		
		Schema::table('blogs', function($table) {
      		$table->foreign('subid')->references('id')->on('blogcats')->onDelete('cascade');
   		});
				
		Schema::table('blogs', function($table) {
      		$table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
   		});
		
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
