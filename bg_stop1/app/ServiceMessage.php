<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceMessage extends Model
{
    protected $table = 'service_messages';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
