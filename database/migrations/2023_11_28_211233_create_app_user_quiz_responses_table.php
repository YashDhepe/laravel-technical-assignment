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
        Schema::create('app_user_quiz_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->unsignedBigInteger('app_user_id');
            $table->foreign('app_user_id')->references('id')->on('app_users')->onDelete('cascade');
            $table->integer('score');
            $table->text('voucher')->nullable();
            $table->decimal('amount')->nullable();
            $table->text('message')->nullable();
            $table->enum('terms_and_conditions',['0','1'])->default('1');
            $table->enum('whatsapp_update',['0','1'])->default('0');
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
        Schema::dropIfExists('app_user_quiz_responses');
    }
};
