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
            $table->string('brand_custom_domain')->nullable()->after('is_anonymize');
            $table->string('brand_embed_url')->nullable()->after('is_anonymize');
            $table->longText('brand_custom_code')->nullable()->after('is_anonymize');
            $table->string('brand_primary_color')->nullable()->after('is_anonymize');
            $table->string('brand_secondary_color')->nullable()->after('is_anonymize');
            $table->string('brand_logo')->nullable()->after('is_anonymize');
            $table->string('brand_popular_by')->nullable()->after('is_anonymize');
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
                'brand_custom_domain',
                'brand_embed_url',
                'brand_custom_code',
                'brand_primary_color',
                'brand_secondary_color',
                'brand_logo',
                'brand_popular_by'
            ]);
        });
    }
};
