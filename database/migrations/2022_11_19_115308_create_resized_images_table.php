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
        Schema::create('resized_images', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('path');
            $table->string('url');
            $table->unsignedMediumInteger('width');
            $table->unsignedMediumInteger('height');
            $table->string('title');
            $table->string('extension');
            $table->string('preview_url');
            $table->unsignedBigInteger('size');
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
        Schema::dropIfExists('resized_images');
    }
};
