<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatingMessage extends Model
{
    protected $table = 'dating_profile_messages';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
