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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('platform')->comment('slack,discord');

            $table->string('team_id')->nullable();
            $table->string('workspace');
            $table->string('app_id')->nullable();
            $table->string('auth_user')->nullable();
            $table->string('user_access_token')->nullable();
            $table->string('bot_user')->nullable();
            $table->string('bot_access_token')->nullable();
            $table->string('scope', 2000)->nullable();

            $table->string('url')->nullable();
            $table->boolean('is_custom_url')->default(false);

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('accounts');
    }
};
