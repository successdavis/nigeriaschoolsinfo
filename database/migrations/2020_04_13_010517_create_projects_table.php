<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('description');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('schooltype_id');
            $table->unsignedInteger('amount');
            $table->unsignedInteger('visits')->default(0);
            $table->boolean('approve')->default(false);
            $table->string('download_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
