<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
//            $table->bigInteger('user_id')->unsigned();
//            $table->bigInteger('follows_id')->unsigned();
            $table->foreignId('follower_id');
            $table->foreignId('user_id');
            $table->foreignId('notification_id')->default(0);
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('follows_id')->references('id')->on('users')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
