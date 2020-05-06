<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('start');
            $table->string('name');
            $table->string('location');
            $table->text('location_metadata');
            $table->string('gender');
            $table->string('age_range');
            $table->string('ad_period');
            $table->string('other_interests')->nullable();
            $table->unsignedBigInteger('goal_id');
            $table->unsignedBigInteger('interest_id');
            $table->unsignedBigInteger('objective_id');
            $table->unsignedBigInteger('media_type_id');
            $table->integer('radius');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('budget')->nullable();
        });

        Schema::table('campaigns', function($table) {
            $table->foreign('category_id')
                ->references('id')->on('categories');
            $table->foreign('interest_id')
                ->references('id')->on('interests');
            $table->foreign('objective_id')
                ->references('id')->on('objectives');
            $table->foreign('goal_id')
                ->references('id')->on('goals');
            $table->foreign('status_id')
                ->references('id')->on('statuses');
            $table->foreign('media_type_id')
                ->references('id')->on('media_types');
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
