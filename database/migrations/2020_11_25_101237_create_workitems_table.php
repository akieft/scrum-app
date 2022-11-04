<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workitems', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->float('effort');
            $table->string('status');
            $table->string('assigned_name');
            $table->unsignedBigInteger('assigned_to');
            $table->unsignedBigInteger('project_id');
            $table->foreign('assigned_to')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('workitems');
    }
}
