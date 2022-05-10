<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vra extends Model
{
    use HasFactory;
    public $timestamps = false;

    function phase(){


        return $this->belongsTo(Phase::class);
    }

    function project(){


        return $this->belongsTo(Project::class);
    }

    protected $fillable = [

            'project_id',
            'phase_id',
           'visibilite',
           'reactivite',
           'avancement',
           'created_at',


    ];
}
