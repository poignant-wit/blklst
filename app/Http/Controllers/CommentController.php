<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request){

        $comment = new Comment();
        $comment->owner_id = Auth::user()->id;
        $comment->target_id = $request->input('target_id');
        $comment->body = $request->input('comment');
        if ( $comment->save()){
            return redirect()->back();
        }

        return "ERROR";




    }
}
