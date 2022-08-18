<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'image', 'from', 'to', 'resturant_id');

    public function resturant()
    {
        return $this->belongsTo('App\models\Resturant');
    }

}