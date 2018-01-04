<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumTopicReply extends Model
{
    protected $table = 'forum_topic_replies';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }
}
