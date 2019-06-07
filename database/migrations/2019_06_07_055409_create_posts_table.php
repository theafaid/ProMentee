<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('field_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('body');
            $table->enum('type', ['advice', 'information', 'request', 'idea', 'other']);

            $table->foreign('field_id')->references('id')->on('fields')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('posts');
    }
}
