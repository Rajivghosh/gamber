<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('user_type')->default(2)->after('name');
            $table->string('google_id', 255)->nullable()->after('password');
            $table->string('facebook_id', 255)->nullable()->after('google_id');
            $table->tinyInteger('terms_conditions')->default(0)->after('remember_token');
            $table->tinyInteger('status')->default(1)->after('terms_conditions');
            $table->renameColumn('name', 'username');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('username', 'name');
            $table->dropColumn('user_type');
            $table->dropColumn('google_id');
            $table->dropColumn('facebook_id');
            $table->dropColumn('terms_conditions');
            $table->dropColumn('status');
        });
    }
}
