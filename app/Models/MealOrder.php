<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MealOrder extends Model 
{

    protected $table = 'meal_order';
    public $timestamps = true;
    protected $fillable = array('order_id', 'meal_id', 'quantity', 'special_order', 'price');

}