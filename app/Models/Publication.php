<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = ['fichiers','commentaire','date_publication','user_id'];
    public $timestamps = false;
    function user(){
        return $this->belongsTo(User::class);
    }

}
