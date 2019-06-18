<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code', 3)->unique();
            $table->string('name', 52);
            $table->enum('continent', ['Asia', 'Europe', 'North America', 'Africa', 'Oceania', 'Antarctica', 'South America']);
            $table->string('region', 26);
            $table->decimal('surface_area', 10, 2);
            $table->integer('population')->length(11)->unsigned();
            $table->decimal('gnp', 10, 2)->nullable();
            $table->decimal('gnp_old', 10, 2)->nullable();
            $table->string('local_name', 45);
            $table->string('government_form', 45);
            $table->integer('capital')->length(11)->unsigned()->nullable();;
            $table->string('code2', 2);
            $table->foreign('capital', 11)->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
