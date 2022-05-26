<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acces extends Model
{
    public function roles(){

        return  $this->belongsToMany(Role::class);

    }
    use HasFactory;
    protected $fillable = ['nom_acces'];
}
