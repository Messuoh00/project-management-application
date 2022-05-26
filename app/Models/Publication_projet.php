<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication_projet extends Model
{
    use HasFactory;

    function user(){
        return $this->belongsTo(User::class);
    }

    function project(){
        return $this->belongsTo(Project::class);
    }

    public $timestamps = false;
    protected $fillable = [
        'publication_id',

        'project_id',

    ];


}
