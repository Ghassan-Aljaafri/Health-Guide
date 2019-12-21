<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // relation added by us
    public function adime()
    {
        return $this->hasOne('App\ADIME', 'patient_id');
    }

    // for patient
    public function foodSystem()
    {
        return $this->hasOne('App\FoodSystem', 'patient_id');
    }

    // for nutritionist
    public function preparedFoodSystems()
    {
        return $this->hasMany('App\FoodSystem', 'nutritionist_id');
    }

    // nutritionist follows patient
    public function followingPatient()
    {
        return $this->hasMany('App\User', 'nutritionist_id');
    }

    public function followerNutritionist()
    {
        return $this->belongsTo('App\User');
    }

    // patient data
    public function informatios()
    {
        return $this->hasMany('App\PatientData', 'patient_id');
    }

    public function writedRecipies()
    {
        return $this->hasMany('App\Recipe', 'nutritionist_id');
    }

}
