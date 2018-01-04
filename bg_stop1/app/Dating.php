<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dating extends Model
{
    protected $table = 'dating_profiles';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }

}
