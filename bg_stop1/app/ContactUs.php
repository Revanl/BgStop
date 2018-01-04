<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
