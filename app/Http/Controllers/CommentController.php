<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentStatus;
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
        $comment->rating = $request->input('rating');
        $comment->status = CommentStatus::where('name', 'waiting')->first()->id;
        if ( $comment->save()){
            return redirect()->back()->with('info', 'Комментарий добавлен, будет доствпен после модерации');
        }
        return redirect()->back()->with('info_danger', 'Возникла ошибка');


    }
}
