<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';



    public function status(){
        return $this->hasOne(CommentStatus::class);
    }

    public function assignStatus($status){
        if (is_string($status)){
            return $this->status()->save(CommentStatus::where('name', $status)->firstOrFail());
        }
        return $this->status()->save($status);
    }
}
