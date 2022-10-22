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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->double('value',20,8)->default(0);
            $table->double('cost',20,4)->default(0);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('currency_id');
            $table->string('image')->nullable();
            $table->string('comment')->nullable();
            $table->index('category_id', 'account_category_idx');
            $table->foreign('category_id','account_category_fk')->on('categories')->references('id');
            $table->index('currency_id', 'account_currency_idx');
            $table->foreign('currency_id','account_currency_fk')->on('currencies')->references('id');
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
        Schema::dropIfExists('accounts');
    }
};
