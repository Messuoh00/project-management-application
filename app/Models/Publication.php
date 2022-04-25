<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = ['fichiers','corps','date_publication','user_id'];

    function user(){
        return $this->belongsTo(User::class);
    }
    
}
