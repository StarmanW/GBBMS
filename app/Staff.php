<?php

namespace App;

use App\Notifications\StaffResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable {
    use Notifiable;

    //Defining custom PK field for Staff, otherwise it will default to "id"
    protected $primaryKey = 'staffID';

    //Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staffID', 'staffPos', 'ICNum', 'birthDate', 'firstName',
        'lastName', 'emailAddress', 'phoneNum', 'homeAddress',
        'gender', 'profileImage', 'staffAccStatus', 'password'
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
        $this->notify(new StaffResetPassword($token));
    }


    /**
     * Method to return the email for password reset
     *
     * @return string Returns the User Email Address
     */
    public function getEmailForPasswordReset() {
        return $this->emailAddress;
    }

    public function routeNotificationFor($driver) {
        if (method_exists($this, $method = 'routeNotificationFor' . Str::studly($driver))) {
            return $this->{$method}();
        }

        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                return $this->emailAddress;
            case 'nexmo':
                return $this->phone_number;
        }
    }

    //One-To-Many EventSchedule Relationship
    public function staffs() {
        return $this->hasMany('App\EventSchedule');
    }
}
