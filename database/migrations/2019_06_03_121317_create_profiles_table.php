<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->enum('gender', ['male', 'female']);

            $table->integer('yob');
            $table->string('pic')->nullable();
            $table->string('motto')->nullable();
            $table->string('bio')->nullable();
            $table->string('job')->nullable();
            $table->string('description')->nullable();
            $table->integer('points')->default(0);
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
        Schema::dropIfExists('profiles');
    }
}
