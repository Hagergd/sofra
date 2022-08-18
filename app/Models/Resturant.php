<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Resturant extends Model 
{

    protected $table = 'resturants';
    public $timestamps = true;
    protected $fillable = array('name', 'phone', 'whats_phone', 'image', 'about_resturant', 'region_id', 'lowest_price', 'email', 'delivery_price', 'password', 'api_token', 'pin_code', 'status', 'commission');

    public function region()
    {
        return $this->belongsTo('App\models\Region');
    }

    public function meals()
    {
        return $this->hasMany('App\models\Meal');
    }

    public function comments()
    {
        return $this->hasMany('App\models\Comment');
    }

    public function orders()
    {
        return $this->hasMany('App\models\Order');
    }

    public function payments()
    {
        return $this->hasMany('App\models\Payment');
    }

    public function oferrs()
    {
        return $this->hasMany('App\models\Offer');
    }

    public function notifications()
    {
        return $this->morphMany('App\models\Notification', 'notificationable');
    }

    public function tokenable()
    {
        return $this->morphMany('App\models\Token', 'clientable');
    }

}