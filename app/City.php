<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['cityname', 'pincode','cloudcover','humidity','temp_C','visibility'];
}
