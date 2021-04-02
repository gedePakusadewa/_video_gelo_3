<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_list', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code', 6);
            $table->text('name');
            $table->text('simple_description');
            $table->text('like_sum');
            $table->text('dislike_sum');
            $table->text('view_sum');
            $table->text('duration');
            $table->text('tag');
            $table->text('thumbnail_path');
            $table->text('video_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_list');
    }
}
