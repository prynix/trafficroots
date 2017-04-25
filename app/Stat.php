<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = ['site_id','zone_id','ad_id','ad_creative_id','country_id','state_code','city_code','platform','os','browser','source','impressions','clicks','date'];
}
