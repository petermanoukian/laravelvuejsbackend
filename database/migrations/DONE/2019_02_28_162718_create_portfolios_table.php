<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
			$table->integer('catid')->unsigned();
			$table->text('description')->nullable();
			$table->string('logo', 255)->nullable();
			$table->string('url', 500)->nullable();
            $table->timestamps();
        });
		
		Schema::table('portfolios', function($table) {
      		$table->foreign('catid')->references('id')->on('portcats')->onDelete('cascade');
   		});
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}
