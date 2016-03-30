<?php

namespace App\Http\Controllers;

use App\Comment;
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

        $user->confirmation_code = str_random(30);
        $user->save();

        $comment = new Comment();
        $comment->owner_id = Auth::user()->id;
        $comment->target_id = $user->id;
        $comment->body = $request->input('comment');
        $comment->rating = $request->input('rating');
        $comment->save();


        $user->assign(Role::where('name', 'candidate')->first());


        return view('candidate.new')->with('info', 'Вы успешно добавили кандидата');
    }

    public function show($id){

        $candidate = User::where('id', $id)
            ->join('user_role', 'users.id', '=', 'user_role.user_id')
            ->where('role_id', Role::where('name', 'candidate')->first()->id)
            ->first();


        if (isset($candidate)){
        if (Gate::allows('show_comments', Auth::user())){
                $comments = $candidate->commentsTarget()
                    ->join('users', 'comments.owner_id', '=', 'users.id')
                    ->get();
             return view('user.details')
                    ->with('candidate', $candidate)
                    ->with('comments', $comments);
            }
            return view('user.details')
                ->with('candidate', $candidate);
        }
      return view('welcome')->with('info_danger', 'Нет такого кандидата');


    }





}
