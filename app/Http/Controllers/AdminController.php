<?php

namespace App\Http\Controllers;

use App\CommentStatus;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;

class AdminController extends Controller
{
    public function index(){



        if (Auth::user()->hasRole('admin')){






//            $users = DB::table('users')
//                ->select('users.name as name', 'email', 'roles.name as role', 'confirmed')
//                ->join('user_role', 'users.id', '=', 'user_role.user_id')
//                ->join('roles', 'role_id', '=', 'roles.id')
//                ->get();


            $comments = DB::table('comments')

               ->select('comments.id as comment_id',
               'owner.name as owner_name',
                   'owner.email as owner_email',
                   'owner.skype as owner_skype',
                   'owner_linkedin.link as owner_linkedin_link ',
                   'target.name as target_name',
                   'target.email as target_email',
                   'target.skype as target_skype',
                   'target_linkedin.link as target_linkedin_link ',
                   'ratings.name as rating',
                   'body',
                   'comment_status.name as status')
                ->join('users as owner', 'owner_id', '=', 'owner.id')
                ->join('users as target', 'target_id', '=', 'target.id')
                ->join('ratings', 'rating', '=', 'ratings.id')
                ->join('comment_status', 'status', '=', 'comment_status.id')
                ->leftJoin('linkedin_links as target_linkedin', 'target_id', '=', 'target_linkedin.user_id')
                ->leftJoin('linkedin_links as owner_linkedin', 'owner_id', '=', 'owner_linkedin.user_id')
                ->where('comment_status.id', CommentStatus::where('name', 'waiting')->first()->id)
                ->get();

//            dd($comments);



            return view('admin.main')
                ->with('comments', $comments);
        }
        return redirect()->route('home');
    }


    public function user($id){

        if (Auth::user()->hasRole('admin')){

            $user = User::where('id','=', $id)->first();
            if (isset($user) && $user->hasRole('candidate')){

                $comments = $user->commentsTarget()->get();
                return view('admin/details')
                    ->with('user', $user)
                    ->with('comments', $comments);
            }elseif(isset($user) && $user->hasRole('recruiter')){

                $comments = $user->commentsOwner()->get();
                return view('admin/details')
                    ->with('user', $user)
                    ->with('comments', $comments);
            }else{
                return "NO FOUND";
            }


        }

        return "NUKK";
    }

}
