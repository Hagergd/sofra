<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'is_read', 'notificationable_id', 'notificationable_type');

    public function notificationable()
    {
        return $this->morphTo();
    }

}