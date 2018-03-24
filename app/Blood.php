<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood extends Model {

    //Many-to-One Donor Relationship
    public function donors() {
        return $this->belongsTo('App\Donor', 'donorID', 'donorID');
    }

    //Many-to-One Event Relationship
    public function events() {
        return $this->belongsTo('App\Event', 'eventID', 'eventID');
    }
}
