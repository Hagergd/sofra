<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{

    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('paid_amount', 'remaining_amount', 'commission_text', 'resturant_id');

    public function resturant()
    {
        return $this->belongsTo('App\models\Resturant');
    }

}