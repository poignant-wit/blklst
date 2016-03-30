<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;

class AdminController extends Controller
{
    public function index(){



        if (Auth::user()->hasRole('admin')){

            $users = DB::table('users')
                ->select('users.name as name', 'email', 'roles.name as role', 'confirmed')
                ->join('user_role', 'users.id', '=', 'user_role.user_id')
                ->join('roles', 'role_id', '=', 'roles.id')
                ->get();

            return view('admin.main')
                ->with('users', $users);
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
