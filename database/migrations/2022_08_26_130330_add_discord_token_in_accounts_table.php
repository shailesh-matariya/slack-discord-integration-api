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
            $table->string('discord_access_token')->nullable()->after('user_scope');
            $table->string('discord_refresh_token')->nullable()->after('user_scope');
            $table->dateTime('discord_access_token_expire_at')->nullable()->after('user_scope');
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
            $table->dropColumn([
                'discord_access_token',
                'discord_refresh_token',
                'discord_access_token_expire_at',
            ]);
        });
    }
};
