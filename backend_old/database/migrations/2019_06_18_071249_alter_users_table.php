<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('users', function($table) {
            $table->string('verification_code', 255)->nullable()->after('status');
            $table->integer('is_verified')->default(0)->after('verification_code')->comment=" 0->not verified, 1->verified";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('verification_code');
            $table->dropColumn('is_verified');
        });
    }
}
