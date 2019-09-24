<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionLevelTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_level_type', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('screen_id');
            $table->foreign('screen_id')->references('id')->on('game_screen')->onDelete('cascade')->onUpdate('no action');
            $table->string('name', 255)->nullable();            
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
        Schema::dropIfExists('competition_level_type');
    }
}
