<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basesubmit', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('base_id');
            $table->foreign('base_id')->references('id')->on('basemodule')->onDelete('cascade');
            $table->string('response');
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
        Schema::dropIfExists('basesubmit');
    }
};
