<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_formats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->text('parameters')->nullable();
            $table->string('thumb_path')->nullable();
            $table->string('image_path')->nullable();
            $table->string('min_bid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_formats');
    }
}
