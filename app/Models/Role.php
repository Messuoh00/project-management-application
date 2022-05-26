<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function acces(){

        return  $this->belongsToMany(acces::class);

    }
    use HasFactory;
    protected $fillable = ['nom_role'];
    
}
