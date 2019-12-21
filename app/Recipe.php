<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // added by us nutritionist who write Recipe 
    public function nutritionist()
    {
        return $this->belongsTo('App\User');
    }
}
