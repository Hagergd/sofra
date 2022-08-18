<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model 
{

    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = array('token', 'api_token', 'platform', 'clientable_id', 'clientable_type');

    public function tokenable()
    {
        return $this->morphTo();
    }

}