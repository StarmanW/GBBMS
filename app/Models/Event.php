<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    //Defining custom PK field for Event, otherwise it will default to "id"
    protected $primaryKey = 'eventID';

    //Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    //Function to get event status in string
    public function getEventStatus() {
        $eventStatus = 'None';

        switch($this->eventStatus) {
            case 0:
                $eventStatus = 'Completed';
                break;
            case 1:
                $eventStatus = 'Upcoming';
                break;
            case 2:
                $eventStatus = 'Cancelled';
                break;
        }

        return $eventStatus;
    }

    //One-To-Many Reservation Relationship
    public function reservations() {
        return $this->hasMany('App\Models\Reservation', 'eventID', 'eventID');
    }

    //One-To-Many Blood Relationship
    public function bloods() {
        return $this->hasMany('App\Models\Blood', 'eventID', 'eventID');
    }

    //One-To-Many EventSchedule Relationship
    public function eventSchedules() {
        return $this->hasMany('App\Models\EventSchedule', 'eventID', 'eventID');
    }

    //One-To-Many EventSchedule Relationship
    public function rooms() {
        return $this->belongsTo('App\Models\Room', 'roomID', 'roomID');
    }
}
