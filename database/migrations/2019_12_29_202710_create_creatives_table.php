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
    {   Schema::enableForeignKeyConstraints();
        Schema::create('creatives', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('advertiser')->nullable();
            $table->string('link')->nullable();
            $table->string('ad_image_size')->nullable(); // resolutions
            $table->string('type')->nullable(); // image only . image with buttons . image text and buttoons
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->string('video_link')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->integer('impressions')->nullable();
            $table->integer('clicks')->nullable();
            $table->integer('devices')->nullable(); //mobile ipad
            $table->integer('supports')->nullable(); // call sms event
            $table->string('ctr')->nullable();
            $table->string('average_bid')->nullable();
            $table->string('vid_type')->nullable();
            $table->string('spend')->nullable();
            $table->string('conversion')->nullable();
            $table->string('conversion_rate')->nullable();
            $table->string('CPA')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('creatives', function($table) {
            $table->foreign('status_id')
                ->references('id')->on('statuses');
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
