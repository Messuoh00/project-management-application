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
        Schema::create('vras', function (Blueprint $table) {


            $table->primary(array('project_id','phase_id','created_at'));

            $table->foreignId('project_id')->constrained();
            $table->foreignId('phase_id')->constrained();



            $table->Integer('visibilite')->default(0);
            $table->Integer('reactivite')->default(0);
            $table->Integer('avancement')->default(0);
            $table->timestamp('created_at')->useCurrent();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vras');
    }
};
