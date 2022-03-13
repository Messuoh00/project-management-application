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
            $table->String('nom_projet');
            $table->String('abreviation');
            $table->String('thematique');
            $table->String('structure_pilote');
            $table->String('phase');
           
            $table->String('region_test');
            $table->String('region_implementation');
            $table->String('region_exploitation');
           
            $table->unsignedDecimal('budget');
          
            $table->timestamp('date_deb')->nullable()->useCurrentOnUpdate();

            $table->timestamp('date_fin')->nullable()->useCurrentOnUpdate();


            $table->String('chef_projet');
            $table->String('equipe');
            $table->String('representant_EP');

            $table->String('etude_echo'); //oui non na
            
            $value=0.0;

            $table->unsignedDecimal('visibilite')->default($value);
            $table->unsignedDecimal('reactivite')->default($value);
            $table->unsignedDecimal('avancement')->default($value);


            $table->text('description')->default('ADD TEXT HERE');

            
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
