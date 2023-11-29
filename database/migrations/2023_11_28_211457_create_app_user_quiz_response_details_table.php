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
        Schema::create('app_user_quiz_response_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_user_quiz_response_id');
            $table->foreign('app_user_quiz_response_id')->references('id')->on('app_user_quiz_responses')->onDelete('cascade');
            $table->unsignedBigInteger('quiz_question_id');
            $table->foreign('quiz_question_id')->references('id')->on('quiz_questions')->onDelete('cascade');
            $table->text('selected_option')->nullable();
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
        Schema::dropIfExists('app_user_quiz_response_details');
    }
};
