<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publicationprojet extends Model
{
    use HasFactory;

    function user(){
        return $this->belongsTo(Publication::class);
    }

    function project(){
        return $this->belongsTo(Project::class);
    }

}
