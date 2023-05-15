<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToFoo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->text('name_en')->after('name')->nullable();
            $table->text('description_en')->after('description')->nullable();
        });
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->text('name_en')->after('name')->nullable();
            $table->text('description_en')->after('description')->nullable();
        });
        Schema::table('services', function (Blueprint $table) {
            $table->text('name_en')->after('name')->nullable();
            $table->text('description_en')->after('description')->nullable();
        });
        Schema::table('plans', function (Blueprint $table) {
            $table->text('title_en')->after('title')->nullable();
            $table->text('description_en')->after('description')->nullable();
        });
        Schema::table('provider_types', function (Blueprint $table) {
            $table->text('name_en')->after('name')->nullable();
        });
        Schema::table('handyman_types', function (Blueprint $table) {
            $table->text('name_en')->after('name')->nullable();
        });
        Schema::table('provider_payouts', function (Blueprint $table) {
            $table->text('description_en')->after('description')->nullable();
        });
        Schema::table('handyman_payouts', function (Blueprint $table) {
            $table->text('description_en')->after('description')->nullable();
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->text('name_en')->after('name')->nullable();
        });
        Schema::table('taxes', function (Blueprint $table) {
            $table->text('title_en',100)->after('title')->nullable();
        });
        Schema::table('sliders', function (Blueprint $table) {
            $table->text('title_en')->after('title')->nullable();
            $table->text('description_en')->after('description')->nullable();
        });
        Schema::table('app_settings', function (Blueprint $table) {
            $table->text('site_name_en')->after('site_name')->nullable();
            $table->text('site_description_en')->after('site_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('foo', function (Blueprint $table) {
            //
        });
    }
}
