<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('user_id')
              ->references('id')->on('users');
            $table->string('name');
            $table->float('price', 20, 4)->nullable();
            $table->date('planned_date')->nullable();
            $table->string('planned_location')->nullable();
            $table->date('rain_date')->nullable();
            $table->string('rain_location')->nullable();
            $table->foreign('site_plan')
              ->references('id')->on('files')
              ->nullable();
            $table->foreign('permit_application')
              ->references('id')->on('files')
              ->nullable();
            $table->foreign('permit')
              ->references('id')->on('files')
              ->nullable();
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
        Schema::dropIfExists('shows');
    }
}
