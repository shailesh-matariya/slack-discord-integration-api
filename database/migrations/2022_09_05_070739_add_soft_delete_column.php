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
        Schema::table('accounts', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('account_users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('account_channels', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('attachments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('reactions', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('account_users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('account_channels', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('reactions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
