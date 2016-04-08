<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentStatus;
use App\Role;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller
{


    public function index(Request $request)
    {
        if (Auth::user()->hasRole('admin')) {
//            $comments = DB::table('comments')
//
//               ->select('comments.id as comment_id',
//               'owner.name as owner_name',
//                   'owner.email as owner_email',
//                   'owner.skype as owner_skype',
//                   'owner_linkedin.link as owner_linkedin_link ',
//                   'target.name as target_name',
//                   'target.email as target_email',
//                   'target.skype as target_skype',
//                   'target_linkedin.link as target_linkedin_link ',
//                   'ratings.name as rating',
//                   'body',
//                   'comment_status.name as status',
//                   'comment_status.id as status_id')
//                ->join('users as owner', 'owner_id', '=', 'owner.id')
//                ->join('users as target', 'target_id', '=', 'target.id')
//                ->join('ratings', 'rating', '=', 'ratings.id')
//                ->join('comment_status', 'status', '=', 'comment_status.id')
//                ->leftJoin('linkedin_links as target_linkedin', 'target_id', '=', 'target_linkedin.user_id')
//                ->leftJoin('linkedin_links as owner_linkedin', 'owner_id', '=', 'owner_linkedin.user_id')
//                ->where('comment_status.id', CommentStatus::where('name', 'waiting')->first()->id)
//                ->get();
//
//            $current_page = ($request->page)? $request->page: 1;
//            $rows_per_page = 5;
//            $offset = ($current_page - 1)  * $rows_per_page;
//            $orders_page = array_slice($comments, $offset, $rows_per_page);
//            $paginator = new LengthAwarePaginator($orders_page, count($comments), $rows_per_page);

//            $comments_waiting = DB::table('comments')
//
//                ->select('comments.id as comment_id',
//                    'owner.name as owner_name',
//                    'owner.email as owner_email',
//                    'owner.skype as owner_skype',
//                    'owner_linkedin.link as owner_linkedin_link ',
//                    'target.name as target_name',
//                    'target.email as target_email',
//                    'target.skype as target_skype',
//                    'target_linkedin.link as target_linkedin_link ',
//                    'ratings.name as rating',
//                    'body',
//                    'comment_status.name as status',
//                    'comment_status.id as status_id')
//                ->join('users as owner', 'owner_id', '=', 'owner.id')
//                ->join('users as target', 'target_id', '=', 'target.id')
//                ->join('ratings', 'rating', '=', 'ratings.id')
//                ->join('comment_status', 'status', '=', 'comment_status.id')
//                ->leftJoin('linkedin_links as target_linkedin', 'target_id', '=', 'target_linkedin.user_id')
//                ->leftJoin('linkedin_links as owner_linkedin', 'owner_id', '=', 'owner_linkedin.user_id')
//                ->where('comment_status.id', CommentStatus::where('name', 'enabled')->first()->id)
//                ->get();

            $status = DB::table('comment_status')
                ->get();

            $comments = $this->getComments($request);

            return view('admin.comments')
//                ->with('comments', $comments['comments'])
                ->with('paginator', $comments['paginator'])
                ->with('statuses', $status);
        }
        return redirect()->route('home');
    }


    public function user($id)
    {
        if (Auth::user()->hasRole('admin')) {
            $user = User::where('id', '=', $id)->first();
            if (isset($user) && $user->hasRole('candidate')) {

                $comments = $user->commentsTarget()->get();
                return view('admin/details')
                    ->with('user', $user)
                    ->with('comments', $comments);
            } elseif (isset($user) && $user->hasRole('recruiter')) {

                $comments = $user->commentsOwner()->get();
                return view('admin/details')
                    ->with('user', $user)
                    ->with('comments', $comments);
            } else {
                return "NO FOUND";
            }
        }

        return "NUKK";
    }


    public function getComments(Request $request)
    {

        $status = ($request->status) ? $request->status : 'waiting';
        $page = ($request->page) ? $request->page : '1';

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
                'comment_status.name as status',
                'comment_status.label as status_label',
                'comment_status.id as status_id')
            ->join('users as owner', 'owner_id', '=', 'owner.id')
            ->join('users as target', 'target_id', '=', 'target.id')
            ->leftJoin('ratings', 'rating', '=', 'ratings.id')
            ->join('comment_status', 'status', '=', 'comment_status.id')
            ->leftJoin('linkedin_links as target_linkedin', 'target_id', '=', 'target_linkedin.user_id')
            ->leftJoin('linkedin_links as owner_linkedin', 'owner_id', '=', 'owner_linkedin.user_id')
            ->where('comment_status.id', CommentStatus::where('name', $status)->first()->id)
            ->get();

        $current_page = ($page) ? $page : 1;
        $rows_per_page = 5;
        $offset = ($current_page - 1) * $rows_per_page;
        $comments_page = array_slice($comments, $offset, $rows_per_page);
        $paginator = new LengthAwarePaginator($comments_page, count($comments), $rows_per_page);

        return [
            'comments' => $comments,
            'paginator' => $paginator
        ];
    }


    public function getTable(Request $request)
    {

        if ($request->ajax()) {

            $status = DB::table('comment_status')
                ->get();
            $comments = $this->getComments($request);
            return view('admin.comments-table')
//                ->with('comments', $comments['comments'])
                ->with('paginator', $comments['paginator'])
                ->with('statuses', $status);
        }
    }


    public function postCommentStatus(Request $request)
    {

        $comment = Comment::find($request->input('comment_id'));
        $comment->status = $request->input('new_status_id');
        $comment->save();
    }

    public function getUsersList(Request $request)
    {

        $role = ($request->role) ? $request->role : 'waiting';
        $page = ($request->page) ? $request->page : '1';

        $users = DB::table('users')
            ->select(
                'users.name as name',
                'users.id as id',
                'email',
                'roles.name as role',
                'roles.id as role_id',
                'confirmed')
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->join('roles', 'role_id', '=', 'roles.id')
            ->where('users.email', '<>', 'admin@admin.com')
            ->orderBy('users.name', 'desc')
            ->get();

        $current_page = ($page) ? $page : 1;
        $rows_per_page = 15;
        $offset = ($current_page - 1) * $rows_per_page;
        $users_page = array_slice($users, $offset, $rows_per_page);
        $paginator = new LengthAwarePaginator($users_page, count($users), $rows_per_page);

        $roles = Role::all();

        if ($request->ajax()) {
            return view('admin.users-table')
                ->with('paginator', $paginator)
                ->with('roles', $roles);
        }

        return view('admin.users')
            ->with('paginator', $paginator)
            ->with('roles', $roles);
    }


    public function postUserRole(Request $request)
    {
        $role = UserRole::where('user_id', $request->input('user_id'))->firstOrFail();
        $role->role_id = $request->input('new_role_id');
        $role->save();
    }

}
