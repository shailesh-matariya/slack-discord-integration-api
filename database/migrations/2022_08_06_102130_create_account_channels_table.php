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
        Schema::create('account_channels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->string('channelId');
            $table->string('name');
            $table->boolean('is_private');
            $table->unsignedInteger('member_count')->default(0);
            $table->boolean('is_visible')->default(0);
            $table->string('last_message_timestamp')->nullable();
            $table->timestamps();

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_channels');
    }
};
