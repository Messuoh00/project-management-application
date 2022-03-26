<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = ['titre','corps','date_publication','user_id'];

    function user(){
        return $this->belongsTo(User::class);
    }
    function fichiers(){
        return $this->hasMany(fichier::class);
    }
}
