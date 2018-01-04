<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentMessage extends Model
{
    protected $table = 'rent_messages';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
