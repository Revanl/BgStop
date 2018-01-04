<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonMessage extends Model
{
    protected $table = 'lesson_messages';
    public $primaryKey = 'id';
    public $timestamps = true;
    public function user(){
        return $this->belongsTo('App\User');
    }

}
