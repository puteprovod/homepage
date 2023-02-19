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
        Schema::create('account_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->double('value',20,8)->default(0);
            $table->double('cost',20,4)->default(0);
            $table->index('account_id', 'account_history_account_idx');
            $table->foreign('account_id','account_history_account_fk')->on('accounts')->references('id');
            $table->dateTime('shot_date');
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
        Schema::dropIfExists('account_histories');
    }
};
