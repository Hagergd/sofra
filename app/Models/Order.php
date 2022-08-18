<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('status', 'address', 'image', 'payment_method', 'order_price', 'delivery_price', 'total_price', 'commission', 'client_id', 'resturant_id');

    public function clients()
    {
        return $this->belongsTo('App\models\Client');
    }

    public function resturant()
    {
        return $this->belongsTo('App\models\Resturant');
    }

    public function meals()
    {
        return $this->belongsToMany('App\models\Meal');
    }

}