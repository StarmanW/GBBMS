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

    //Get Blood Type in string
    public function getBloodTypeString() {
        $bloodTypeString = "None";

        switch ($this->bloodType) {
            case 1:
                $bloodTypeString = "A+";
                break;
            case 2:
                $bloodTypeString = "A-";
                break;
            case 3:
                $bloodTypeString = "B+";
                break;
            case 4:
                $bloodTypeString = "B-";
                break;
            case 5:
                $bloodTypeString = "O+";
                break;
            case 6:
                $bloodTypeString = "O-";
                break;
            case 7:
                $bloodTypeString = "AB+";
                break;
            case 8:
                $bloodTypeString = "AB-";
                break;
        }
        return $bloodTypeString;
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

    //One-To-Many Reservation Relationship
    public function reservations() {
        return $this->hasMany('App\Reservation');
    }

    //One-To-Many Blood Relationship
    public function bloods() {
        return $this->hasMany('App\Blood');
    }
}
