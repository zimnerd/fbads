<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creatives', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('advertiser')->nullable();
            $table->enum('type',['Video upload','URL']);
            $table->enum('delivery_type',['streaming','progressive']);
            $table->string('title')->nullable();
            $table->string('placeholder_path')->nullable();
            $table->string('layout_name');
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->string('video_url')->nullable();
            $table->string('click_url')->nullable();
            $table->unsignedBigInteger('ad_format_id')->nullable();
            $table->unsignedBigInteger('campaign_id')->nullable();
        });
        Schema::table('creatives', function($table) {
            $table->foreign('ad_format_id')
                ->references('id')->on('ad_formats');
            $table->foreign('campaign_id')
                ->references('id')->on('campaigns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creatives');
    }
}
