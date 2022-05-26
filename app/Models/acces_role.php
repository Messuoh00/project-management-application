<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acces_role extends Model
{
    protected $table = 'acces_role';

    use HasFactory;
    protected $fillable = ['role_id','acces_id'];
}
