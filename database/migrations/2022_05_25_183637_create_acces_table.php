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
        Schema::create('acces', function (Blueprint $table) {
            $table->id();
            $table->string('nom_acces');
            $table->timestamps();
        });
        $data = [
            [ 'nom_acces' => 'tous les privileges' ],
            [ 'nom_acces' => 'lecture de projet affecté' ],
            [ 'nom_acces' => 'ecriture de projet affecté' ],
            [ 'nom_acces' => 'ecriture de projet affecté que en etant chef/représentant du projet' ],
            [ 'nom_acces' => 'lecture de tous les projets' ],
            [ 'nom_acces' => 'lecture de projets de la meme division' ],
            [ 'nom_acces' => 'ecriture de projets de la meme division' ],
            [ 'nom_acces' => 'ecriture de tous les projets' ],
            [ 'nom_acces' => 'gérer les fichiers de espace equipe des projets accessibles en lecture' ],
            [ 'nom_acces' => 'gérer les fichiers des projets affectés(sans pouvoir modifier projet) que en etant chef/représentant du projet'],
            [ 'nom_acces' => 'gérer les fichiers des projets affectés(sans pouvoir modifier projet)'],
            [ 'nom_acces' => 'consultation des statistiques' ],
            [ 'nom_acces' => 'gestion des utilisateurs' ],
            [ 'nom_acces' => 'gestion des divisions' ],
            [ 'nom_acces' => 'gestion des phases' ],
            [ 'nom_acces' => 'consultation historique equipe des projets accessibles en lecture' ],
            [ 'nom_acces' => 'gestion des roles' ],
            [ 'nom_acces' => 'création projet' ],
          
         ];

        DB::table('acces')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acces');
    }
};
