<?php

use App\Models\School;
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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('county');
            $table->string('lat');
            $table->string('lon');


            $table->timestamps();
        });


        School::truncate();
        $csvFile = fopen(base_path("database/data/publicschools.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                School::create([
                    "id" => $data['0'],
                    "name" => $data['1'],
                    "address" => $data['2'],
                    "city" => $data['3'],
                    "state" => $data['4'],
                    "zip" => $data['5'],
                    "county" => $data['6'],
                    "lat" => $data['7'],
                    "lon" => $data['8'],

                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
};
