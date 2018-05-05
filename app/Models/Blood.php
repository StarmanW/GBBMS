<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blood extends Model {

    //Defining custom table
    protected $table = 'blood';

    //Defining custom PK field for Blood, otherwise it will default to "id"
    protected $primaryKey = 'bloodBagID';

    //Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    //Many-to-One Donor Relationship
    public function donors() {
        return $this->belongsTo('App\Models\Donor', 'donorID', 'donorID');
    }

    //Many-to-One Event Relationship
    public function events() {
        return $this->belongsTo('App\Models\Event', 'eventID', 'eventID');
    }
}
