<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->unsignedInteger('user_id');
            $table->text('description');
            $table->string('portal_website')->nullable();
            $table->string('location');
            $table->string('institution')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('admitting')->default(false);
            $table->timestamp('ends_at')->nullable();
            $table->unsignedInteger('visits')->default(0);
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
        Schema::dropIfExists('scholarships');
    }
}
