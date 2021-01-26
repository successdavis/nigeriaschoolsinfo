<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_programme', function (Blueprint $table) {
            $table->primary(['programme_id', 'courses_id']);
            
            $table->unsignedBigInteger('programme_id');
            $table->unsignedBigInteger('courses_id');
            $table->timestamps();

            $table->foreign('courses_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->foreign('programme_id')
                ->references('id')
                ->on('programmes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_programs');
    }
}
