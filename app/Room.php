<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model {

    //Defining custom table
    protected $table = 'room';

    //Defining custom PK field for Blood, otherwise it will default to "id"
    protected $primaryKey = 'roomID';

    //Set incrementing to false, otherwise the PK field will be cast to INTEGER
    public $incrementing = false;

    //Many-to-One Event Relationship
    public function events() {
        return $this->hasMany('App\Event');
    }
}
