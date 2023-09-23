<?php

use App\Models\Zipcode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zipcodes', function (Blueprint $table) {
            $table->id();

            $table->string('zip')->nullable;
            $table->string('type')->nullable;
            $table->string('city')->nullable;
            $table->string('typeb')->nullable;
            $table->string('statename')->nullable;
            $table->string('stateabv')->nullable;
            $table->string('code')->nullable;
            $table->string('lat')->nullable;
            $table->string('lng')->nullable;
            $table->string('country')->nullable;
            $table->string('status')->nullable;


            $table->timestamps();
        });
/*
 *

        Zipcode::truncate();
        $csvFile = fopen(base_path("database/data/zips.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Zipcode::create([
                    "id" => $data['0'],
                    "zip" => $data['1'],
                    "type" => $data['2'],
                    "city" => $data['3'],
                    "typeb" => $data['4'],
                    "statename" => $data['5'],
                    "stateabv" => $data['6'],
                    "code" => $data['7'],
                    "lat" => $data['8'],
                    "lng" => $data['9'],
                    "country" => $data['10'],
                    "status" => $data['11'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);

*/


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zipcodes');
    }
};
