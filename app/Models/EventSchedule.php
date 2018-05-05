<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model {

    //Defining custom PK field for EventSchedule, otherwise it will default to "id"
    protected $primaryKey = 'schedID';

    //Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    //Many-to-One Staff Relationship
    public function staffs() {
        return $this->belongsTo('App\Models\Staff', 'staffID', 'staffID');
    }

    //Many-to-One Event Relationship
    public function events() {
        return $this->belongsTo('App\Models\Event', 'eventID', 'eventID');
    }
}
