<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescription2Abouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('abouts', function(Blueprint $table) 
	   {
			$table->text('description2')->nullable()->after('description');
	   });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('abouts', function(Blueprint $table) 
	   {
			$table->dropColumn('description2');
	   });
    }
}
