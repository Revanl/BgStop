<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class forumCategory extends Model
{
    protected $table = 'forum_categories';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
