<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodSystem extends Model
{
    // relation added by us
    public function patient()
    {
        return $this->belongsTo('App\User');
    }

    public function nutritionist()
    {
        return $this->belongsTo('App\User');
    }
}
