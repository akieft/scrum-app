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
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->date('end_date');
            $table->string('owner_name');
            $table->string('scrum_name');
            $table->unsignedBigInteger('product_owner');
            $table->unsignedBigInteger('scrum_master');
            $table->foreign('product_owner')->references('id')->on('users');
            $table->foreign('scrum_master')->references('id')->on('users');
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
