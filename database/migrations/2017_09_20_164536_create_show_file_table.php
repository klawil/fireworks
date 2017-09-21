<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_file', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('show_id');
            $table->integer('file_id');
            $table->string('relationship')->nullable();
            $table->boolean('shooter_viewable')->default(False);
            $table->boolean('driver_viewable')->default(False);
            $table->boolean('assistant_viewable')->default(False);
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
        Schema::dropIfExists('show_file');
    }
}
