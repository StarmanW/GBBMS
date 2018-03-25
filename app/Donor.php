<?php

namespace App;

use App\Notifications\DonorResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Donor extends Authenticatable {
    use Notifiable;

    //Defining custom PK field for Donor, otherwise it will default to "id"
    protected $primaryKey = 'donorID';

    //Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'donorID', 'password', 'ICNum', 'birthDate', 'firstName',
        'lastName', 'emailAddress', 'phoneNum', 'homeAddress',
        'bloodType', 'donorAccStatus'
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
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token) {
        $this->notify(new DonorResetPassword($token));
    }

    //One-To-Many Reservation Relationship
    public function reservations() {
        return $this->hasMany('App\Reservation');
    }

    //One-To-Many Blood Relationship
    public function bloods() {
        return $this->hasMany('App\Blood');
    }
}
