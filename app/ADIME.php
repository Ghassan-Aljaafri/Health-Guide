<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ADIME extends Model
{
    // relation added by us
    public function patient()
    {
        return $this->belongsTo('App\User');
    }
}
