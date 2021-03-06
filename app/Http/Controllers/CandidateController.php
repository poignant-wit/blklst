<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentStatus;
use App\Role;
use App\User;
use Auth;
use Gate;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

class CandidateController extends Controller
{
    private $candidate_rules = [
        'name' => 'required',
        'email' => 'required|email|max:255|unique:users',
        'comment' => 'required',
    ];

    protected function validator(array $data, array $rules)
    {
        return Validator::make($data, $rules);
    }


    /**
     * @param Request $request
     * @param $rules
     * @throws \Illuminate\Foundation\Validation\ValidationException
     */
    protected function validateRequest(Request $request, $rules)
    {
        $validator = $this->validator($request->all(), $rules);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
    }


    public function create(){

        $ratings = DB::table('ratings')->get();
        return view('candidate.new')
            ->with('ratings', $ratings);
    }

    public function store(Request $request){

        $this->validateRequest($request, $this->candidate_rules);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($request->input('skype')) $user->skype = $request->input('skype');
        $user->confirmation_code = str_random(30);
        $user->save();


//        DB::table('user_skype')->insert([
//           'user_id' => $user->id,
//            'skype' => $request->input('skype')
//        ]);

        $comment = new Comment();
        $comment->owner_id = Auth::user()->id;
        $comment->target_id = $user->id;
        $comment->body = $request->input('comment');
        $comment->rating = $request->input('rating');
        $comment->status = CommentStatus::where('name', 'waiting')->first()->id;
        $comment->save();


        $user->assign('candidate');


        return view('candidate.new')->with('info', 'Вы успешно добавили кандидата');
    }

    public function show($id){


        $user = User::where('id', $id)
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
//            ->where('role_id', '<>' ,Role::where('name', 'unconfirmed')->first()->id)
            ->first();


        if((Auth::check()) && ($id == Auth::user()->id)){

            if(Auth::user()->hasRole('unconfirmed'))
            {
                return view('user.home')
                    ->with('user', $user);
            }else{
                $comments = Comment::byTargetUser($user);
                return view('user.home')
                    ->with('user', $user)
                    ->with('comments', $comments);
            }
        }




        $candidate = User::where('id', $id)
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
//            ->where('role_id', Role::where('name', 'admin')->first()->id)
//            ->where('role_id', '<>' ,Role::where('name', 'unconfirmed')->first()->id)
            ->first();



        if (isset($candidate)){
        if (Gate::allows('show_comments', Auth::user())){
                $comments = $candidate->commentsTarget()
                    ->select(
                        'users.name as user_name',
                        'comments.body as comment_body',
                        'comment_status.id as comment_status_id'
                        )
                    ->join('users', 'comments.owner_id', '=', 'users.id')
                    ->join('comment_status', 'status', '=', 'comment_status.id')
                    ->where('comment_status.id', '=', DB::table('comment_status')->where('name', 'enabled')->first()->id)
                    ->get();
            $ratings = DB::table('ratings')->get();

             return view('user.details')
                    ->with('candidate', $candidate)
                    ->with('ratings', $ratings)
                    ->with('comments', $comments);
            }
            return view('user.details')
                ->with('candidate', $candidate);
        }
      return view('welcome')->with('info_danger', 'Нет такого кандидата');
    }


}
