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
        Schema::create('re_tweets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tweet_id')->constrained('tweets')->onDelete('cascade');
            $table->foreignId('re_tweet_id')->constrained('tweets')->onDelete('cascade');
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
        Schema::dropIfExists('re_tweets');
    }
};
