<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model {
    //Many-to-One Staff Relationship
    public function staffs() {
        return $this->belongsTo('App\Staff', 'staffID', 'staffID');
    }

    //Many-to-One Event Relationship
    public function events() {
        return $this->belongsTo('App\Event', 'eventID', 'eventID');
    }
}
