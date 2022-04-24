<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    public function user(){

        return  $this->belongsToMany(User::class);

    }

    // public function departement(){

    //     return  $this->hasOne(Departement::class);

    // }


    protected $fillable = [
        'nom_projet',
        'abreviation' ,
        'thematique',
        'structure_pilote',
        'phase',
        'files',
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
         
                
        'visibilite',
        'reactivite',
        'avancement',

        'description',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    
}
