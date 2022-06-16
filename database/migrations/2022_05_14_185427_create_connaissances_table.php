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
        Schema::create('connaissances', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('discipline')->nullable();
            $table->text('corps')->nullable();
            $table->string('fichiers');
           
            $table->foreignId('user_id')->constrained()->onDelete("cascade");

            $table->timestamp('date_publication')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connaissances');
    }
};
