<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    protected $table = "expertises";

    protected $fillable = ['field_of_expertise','expertise_details','research_topics','achievements']; 
}
