<?php

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
        Schema::create('projects', function (Blueprint $table) {


            $table->id('id');

            $table->String('nom_projet')->nullable();
            $table->String('abreviation')->nullable();
            $table->String('thematique')->nullable();




            $table->foreignId('phase_id')->nullable()->constrained();
            $table->foreignId('departement_id')->nullable()->constrained();


            $table->String('region_test')->nullable();
            $table->String('region_implementation')->nullable();
            $table->String('region_exploitation')->nullable();

            $table->bigInteger('budget')->nullable();

            $table->timestamp('date_deb')->nullable();

            $table->timestamp('date_fin')->nullable();



            $table->String('etude_echo')->default('na'); //oui non na




            $table->text('description')->default('ADD TEXT HERE')->nullable();
            $table->String('files')->nullable();

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
        Schema::dropIfExists('projects');
    }
};
