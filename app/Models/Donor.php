<?php

namespace App\Models;

use App\Notifications\DonorResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

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
        'gender', 'profileImage', 'bloodType', 'donorAccStatus'
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
                $bloodTypeString = "A Positive";
                break;
            case 2:
                $bloodTypeString = "A Negative";
                break;
            case 3:
                $bloodTypeString = "B Positive";
                break;
            case 4:
                $bloodTypeString = "B Negative";
                break;
            case 5:
                $bloodTypeString = "O Positive";
                break;
            case 6:
                $bloodTypeString = "O Negative";
                break;
            case 7:
                $bloodTypeString = "AB Positive";
                break;
            case 8:
                $bloodTypeString = "AB Negative";
                break;
        }
        return $bloodTypeString;
    }

    //Get account status in string
    public function getAccStatus() {
        $accStatus = 'None';

        switch($this->donorAccStatus) {
            case 1:
                $accStatus = 'Active';
                break;
            case 0:
                $accStatus = 'Deactivated';
                break;
        }
        return $accStatus;
    }

    //Get Gender in string
    public function getGender() {
        $gender = 'None';
        if($this->gender === 1) {
            $gender = 'Male';
        } elseif($this->gender === 0) {
            $gender = 'Female';
        }
        return $gender;
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
        return $this->hasMany('App\Models\Reservation', 'donorID');
    }

    //One-To-Many Blood Relationship
    public function bloods() {
        return $this->hasMany('App\Models\Blood', 'donorID', 'donorID');
    }
}
