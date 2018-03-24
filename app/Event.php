<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //

    //One-To-Many Reservation Relationship
    public function reservations(){
        return $this->hasMany('App\Reservation');
    }

    //One-To-Many Blood Relationship
    public function bloods(){
        return $this->hasMany('App\Blood');
    }

    //One-To-Many EventSchedule Relationship
    public function eventSchedules(){
        return $this->hasMany('App\EventSchedule');
    }
}
