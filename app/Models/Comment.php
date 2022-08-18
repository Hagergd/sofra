<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{

    protected $table = 'comments';
    public $timestamps = true;
    protected $fillable = array('comment', 'client_id', 'resturant_id', 'rate');

    public function client()
    {
        return $this->belongsTo('App\models\Client');
    }

    public function resturant()
    {
        return $this->belongsTo('App\models\Resturant');
    }

}