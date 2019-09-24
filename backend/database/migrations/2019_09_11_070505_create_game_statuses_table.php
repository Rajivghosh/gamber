<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game__statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('user_id')->nullable();
            $table->tinyInteger('event_id')->nullable();
            $table->tinyInteger('category_id')->nullable();
            $table->tinyInteger('level_id')->nullable();
            $table->tinyInteger('game_id')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 => finished, 1 => On-going');
            $table->string('total_score')->nullable();
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
        Schema::dropIfExists('game__statuses');
    }
}
