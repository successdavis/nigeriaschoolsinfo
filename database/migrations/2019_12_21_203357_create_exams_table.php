<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('short_name');
            $table->string('description');
            $table->string('logo_path')->nullable();
            $table->string('website')->nullable();
            $table->date('date_created')->nullable();
            $table->string('portal-website')->nullable();
            $table->boolean('admitting')->default(false);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('exams');
    }
}
