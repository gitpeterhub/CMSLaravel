<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = "skills";

    protected $fillable = ['certificate_title','major','start_date','end_date','institution','board','score','description','type','order']; 
}
