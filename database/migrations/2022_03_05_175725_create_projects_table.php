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
            $table->String('structure_pilote')->nullable();

            // $table->Integer('departement_id')->nullable();

            $table->String('phase')->nullable();

            $table->String('region_test')->nullable();
            $table->String('region_implementation')->nullable();
            $table->String('region_exploitation')->nullable();

            $table->bigInteger('budget')->nullable();

            $table->timestamp('date_deb')->nullable();

            $table->timestamp('date_fin')->nullable();


            $table->String('extras')->nullable();





            $table->String('etude_echo')->nullable(); //oui non na

            $value=0.0;

            $table->unsignedDecimal('visibilite')->default($value);
            $table->unsignedDecimal('reactivite')->default($value);
            $table->unsignedDecimal('avancement')->default($value);


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
