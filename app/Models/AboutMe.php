<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    protected $table = "about_me";

    protected $fillable = ['name','email','phone','social_links','websites','address','company','position','birthday','marital_status','gender','nationality','religion','interests','hobbies','strengths','achievements','skills','languages','about_me','photo','photo_url','references'];

}
