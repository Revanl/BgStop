<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseMessage extends Model
{
    protected $table = 'purchase_messages';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
