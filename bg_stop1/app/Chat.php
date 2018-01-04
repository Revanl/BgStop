<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function users(){
        return $this->belongsTo('App\User');
    }
}
