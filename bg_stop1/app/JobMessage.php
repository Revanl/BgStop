<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobMessage extends Model
{
    protected $table = 'job_messages';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
