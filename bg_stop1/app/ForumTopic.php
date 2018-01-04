<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumTopic extends Model
{
    protected $table = 'forum_topics';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
