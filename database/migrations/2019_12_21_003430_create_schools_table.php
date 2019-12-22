<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->date('date_created')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('website')->nullable();
            $table->string('portal-website')->nullable();
            $table->unsignedInteger('state');
            $table->unsignedInteger('lga');
            $table->text('address')->nullable();
            $table->boolean('admitting')->default(false);
            $table->string('type'); // University, Polytechnics, Nurses School
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
        Schema::dropIfExists('schools');
    }
}
