<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CoursesSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_subject', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('courses_id');
            $table->unsignedInteger('subject_id');

            $table->unique(['courses_id', 'subject_id'], 'This Relationship a lready exists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_subject');
    }
}
