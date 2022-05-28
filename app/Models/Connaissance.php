<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connaissance extends Model
{
    protected $fillable = ['fichiers','corps','date_publication','user_id','titre','discipline'];
    public $timestamps = false;
    function user(){
        return $this->belongsTo(User::class);
    }
    
    use HasFactory;
}
