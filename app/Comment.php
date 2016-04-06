<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public static function byTargetUser(User $user){

        return $user->commentsTarget()
            ->select(
                'users.name as user_name',
                'comments.body as comment_body',
                'comment_status.id as comment_status_id'
            )
            ->join('users', 'comments.owner_id', '=', 'users.id')
            ->join('comment_status', 'status', '=', 'comment_status.id')
            ->where('comment_status.id', '=', DB::table('comment_status')->where('name', 'enabled')->first()->id)
            ->get();

    }



}
