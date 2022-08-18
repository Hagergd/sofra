<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model 
{

    protected $table = 'meals';
    public $timestamps = true;
    protected $fillable = array('meal_name', 'description', 'price', 'offer_price', 'image', 'prepare_time', 'category_id', 'resturant_id');

    public function resturant()
    {
        return $this->belongsTo('App\models\Resturant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\models\Order');
    }

    public function category()
    {
        return $this->belongsTo('App\models\Category');
    }

}