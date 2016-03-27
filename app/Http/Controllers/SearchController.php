<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{
    public function results(Request $request)
    {
        $query = $request->input('query');
        $sub_query = DB::table('users')
            ->where('email', 'LIKE', '%' . $query . '%')
            ->orWhere('name', 'LIKE', '%' . $query . '%')
            ->join('user_role', 'users.id', '=', 'user_role.user_id');

        $s = $sub_query->toSql();
        $users = DB::table(DB::raw("($s) as a"))
            ->mergeBindings($sub_query)
//            ->where('confirmed', '=', 1)
            ->where('role_id', '=', Role::where('name', 'candidate')->first()->id)
            ->get();


//        dd(count($users));



            return view('welcome')
                ->with('users', $users);

    }
}
