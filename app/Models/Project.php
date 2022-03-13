<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;



    protected $fillable = [
        'nom_projet',
        'abreviation' ,
        'thematique',
        'structure_pilote',
        'phase',
        
        'region_test',
        'region_implementation',
        'region_exploitation',
        
        'budget',

        'date_deb',
        'date_fin',

        'chef_projet',
        'equipe' ,
        'representant_EP' ,

        'etude_echo'  ,
         
         


        'description',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    
}
