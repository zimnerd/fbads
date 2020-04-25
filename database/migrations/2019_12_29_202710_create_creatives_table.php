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
            $table->string('link')->nullable();
            $table->string('title');
            $table->text('description');
            $table->text('notes')->nullable();
            $table->text('comments')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->integer('reach')->nullable();
            $table->integer('clicks')->nullable();
            $table->integer('landing_clicks')->nullable();
            $table->integer('other_clicks')->nullable();
            $table->string('facebook_email')->nullable();
            $table->string('facebook_page')->nullable();
            $table->integer('setup')->nullable();
            $table->integer('ready')->nullable();
            $table->integer('active')->nullable();
            $table->integer('finished')->nullable();
            $table->string('frequency')->nullable();
            $table->string('video_views')->nullable();
            $table->string('engagement_rate')->nullable();
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
