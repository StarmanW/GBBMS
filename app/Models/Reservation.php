<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {

    //Defining custom PK field for Reservation, otherwise it will default to "id"
    protected $primaryKey = 'resvID';

    //Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    public function getResvStatus() {
        $resvStatus = 'None';

        switch ($this->resvStatus) {
            case 0:
                $resvStatus = 'Completed';
                break;
            case 1:
                $resvStatus = 'Reserved';
                break;
            case 2:
                $resvStatus = 'Did not attend';
                break;
            case 3:
                $resvStatus = 'Cancelled by Donor';
                break;
            case 4:
                $resvStatus = 'Event cancelled';
                break;
        }

        return $resvStatus;
    }

    //Many-to-One Donor Relationship
    public function donors() {
        return $this->belongsTo('App\Models\Donor', 'donorID', 'donorID');
    }

    //Many-to-One Event Relationship
    public function events() {
        return $this->belongsTo('App\Models\Event', 'eventID', 'eventID');
    }
}
