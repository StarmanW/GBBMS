<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {

    //Defining custom PK field for Reservation, otherwise it will default to "id"
    protected $primaryKey = 'resvID';

    //Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    //Many-to-One Donor Relationship
    public function donors() {
        return $this->belongsTo('App\Donor', 'donorID', 'donorID');
    }

    //Many-to-One Event Relationship
    public function events() {
        return $this->belongsTo('App\Event', 'eventID', 'eventID');
    }
}
