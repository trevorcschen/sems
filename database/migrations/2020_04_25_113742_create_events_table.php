<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->dateTime('start_time', 0);
            $table->dateTime('end_time', 0);
            $table->string('image_URL');
            $table->integer('max_participants');
            $table->double('fee', 8, 2);
            $table->unsignedBigInteger('community_id');
            $table->unsignedBigInteger('venue_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('community_id')
                ->references('id')->on('communities')
                ->onDelete('cascade');
            $table->foreign('venue_id')
                ->references('id')->on('venues')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
