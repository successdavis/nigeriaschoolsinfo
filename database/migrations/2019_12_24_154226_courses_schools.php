<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoursesSchools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_schools', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedInteger('courses_id');
            $table->unsignedInteger('schools_id');
            $table->integer('cut_off_points')->nullable();

            $table->unique(['courses_id', 'schools_id'], 'Relationship a lready exists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_schools');
    }
}
