<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('show_id');
            $table->float('payment', 10, 2)->nullable();
            $table->boolean('is_owner')->default(False);
            $table->boolean('is_shooter')->default(False);
            $table->boolean('is_driver')->default(False);
            $table->boolean('is_assistant')->default(False);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('show_user');
    }
}
