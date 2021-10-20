<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSobresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sobres', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('tamanho')->nullable();
            $table->string('etnia')->nullable();
            $table->string('peso')->nullable();
            $table->string('tatuagem')->nullable();
            $table->string('peitos')->nullable();
            $table->string('olhos')->nullable();
            $table->string('cabelo')->nullable();
            $table->string('pes')->nullable();
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
        Schema::dropIfExists('sobres');
    }
}
