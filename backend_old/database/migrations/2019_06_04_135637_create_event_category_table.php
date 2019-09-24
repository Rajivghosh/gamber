<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('level_id');
            $table->foreign('level_id')->references('id')->on('competition_level_type')->onDelete('cascade')->onUpdate('no action');
            $table->unsignedInteger('screen_id');
            $table->string('name', 255)->nullable(); 
            $table->string('details', 255)->nullable(); 
            $table->integer('category_parent_id')->default(0); 
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
        Schema::dropIfExists('event_category');
    }
}
