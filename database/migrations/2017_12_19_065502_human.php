<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Human extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people', function (Blueprint $table) {                      
            $table->string('person_country')->after('mobile_number'); 
            $table->string('person_state')->after('person_country');
            $table->string('person_city')->after('person_state');
            $table->string('person_street')->after('person_city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table){
          $table->dropColumn('person_country');
          $table->dropColumn('person_state');
          $table->dropColumn('person_city');
          $table->dropColumn('person_street');
        });
    }
}
