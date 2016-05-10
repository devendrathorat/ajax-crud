<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\City;
class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cityname');
            $table->string('pincode');
            $table->string('cloudcover');
            $table->string('humidity');
            $table->string('temp_C');
            $table->string('visibility');
            $table->timestamps();
        });
          City::create([
            'cityname' => 'Pune',
            'pincode' => '412301',
                     ]);
            City::create([
            'cityname' => 'Mumbai',
            'pincode' => '442501',
                     ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cities');
    }
}
