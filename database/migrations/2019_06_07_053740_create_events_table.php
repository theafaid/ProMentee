<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('field_id');
            $table->foreign('field_id')->references('id')->on('fields')
                ->onDelete('cascade');
//            $table->unsignedSmallInteger('user_id');
//            $table->foreign('user_id')->references('id')->on('users')
//                ->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->boolean('premium')->default(false);
            $table->string('pic')->nullable();
            $table->string('video')->nullable();
            // country_id
            // city_id
            // location
            // start_date
            // end_date
            // min_required_members
            // max_required_members
            // allow_less_than_min_count ?
            // allow_less_than_max_count
            // allow_rating
            // required_age_from
            // required_age_to
            // required_city
            // required_level
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
        Schema::dropIfExists('events');
    }
}
