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
        Schema::create('phases', function (Blueprint $table) {
            $table->id('id');
            $table->Integer('position')->nullable();

            $table->String('name')->nullable();
            $table->timestamps();
        });


        $data = [
            [ 'position' => 0,'name' => 'Idee R/D non valide'],
            [ 'position' => 1,'name' => 'Idee R/D '],
            [ 'position' => 2,'name' => 'Maturation'],
            [ 'position' => 3,'name' => 'Recherche'],
            [ 'position' => 4,'name' => 'Test Pilote'],
            [ 'position' => 5,'name' => 'Implementation'],
            [ 'position' => 6,'name' => 'Exploitation'],

         ];

        DB::table('phases')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phases');
    }
};
