<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'pin_code', 'api_token', 'is_active', 'region_id');

    public function region()
    {
        return $this->belongsTo('App\models\Region');
    }

    public function notifications()
    {
        return $this->morphMany('App\models\Notification', 'notificationable');
    }

    public function contacts()
    {
        return $this->hasMany('App\models\Contact');
    }

    public function comments()
    {
        return $this->hasMany('App\models\Comment');
    }

    public function orders()
    {
        return $this->hasMany('App\models\Order');
    }

    public function tokens()
    {
        return $this->morphMany('App\models\Token', 'clientable');
    }

}