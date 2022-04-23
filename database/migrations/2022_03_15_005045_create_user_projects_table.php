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
        Schema::create('project_user', function (Blueprint $table) {

            $table->primary(array('user_id', 'project_id','statut'));

            $table->integer('statut')->unsigned()->default(0);

            $table->integer('post')->unsigned()->default(3);



            $table->foreignId('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");

            $table->foreignId('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete("cascade");

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
        Schema::dropIfExists('user_projects');
    }
};
