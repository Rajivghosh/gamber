<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_event', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->unsignedInteger('cat_id');
            $table->foreign('cat_id')->references('id')->on('event_category')->onDelete('cascade')->onUpdate('no action');
            $table->string('event_type', 255)->nullable();
            $table->string('game_type', 255)->nullable();
            $table->string('venue', 255)->nullable();
            $table->string('control_type', 255)->nullable();
            $table->unsignedInteger('match_length');
            $table->integer('entry_fees');
            $table->integer('total_entries');
            $table->string('prize_pool', 255)->nullable();
            $table->integer('event_duration');
            $table->string('event_sponson', 255)->nullable();
            $table->string('event_rule', 255)->nullable();
            $table->dateTime('event_start_date');
            $table->dateTime('event_end_date');
            $table->integer('event_status')->default(0);
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
        Schema::dropIfExists('game_event');
    }
}
