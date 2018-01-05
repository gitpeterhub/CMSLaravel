<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = "experiences";

    protected $fillable = ['company_name','joined_date','resigned_date','position','about_job','duties','projects','achievements','company_email','company_phone','company_address','company_websites','company_established','about_company'];
}
