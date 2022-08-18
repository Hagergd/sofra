<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model 
{

    protected $table = 'regions';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id');

    public function clients()
    {
        return $this->hasMany('App\models\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\models\City');
    }

    public function resturants()
    {
        return $this->hasMany('App\models\Resturant');
    }

}