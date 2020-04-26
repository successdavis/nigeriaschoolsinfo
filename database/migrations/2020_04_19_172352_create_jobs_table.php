<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'id', "title", "description", "portal_website", "ends_at", "phone", "location","employer","meta_description","slug"
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->unsignedInteger('user_id');
            $table->text('description');
            $table->string('portal_website')->nullable();
            $table->string('phone')->nullable();
            $table->string('location');
            $table->string('employer')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('recruiting')->default(false);
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
        Schema::dropIfExists('jobs');
    }
}
