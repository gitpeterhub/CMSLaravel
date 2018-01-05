<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = "educations";

    protected $fillable = ['degree','major','enrolled_year','graduation_year','institution','institution_address','board_or_university','score','achievements'];
}
