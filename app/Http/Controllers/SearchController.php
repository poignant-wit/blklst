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

//        dd($query);
        if (preg_match("/^[\s]*$/", $query)){
        return redirect()->back();
    }

        $sub_query = DB::table('users')
            ->where('email', 'LIKE', '%' . $query . '%')
            ->orWhere('name', 'LIKE', '%' . $query . '%')
            ->join('user_role', 'users.id', '=', 'user_role.user_id');



        $s = $sub_query->toSql();
        $users = DB::table(DB::raw("($s) as a"))
            ->mergeBindings($sub_query)
            ->where('role_id', '<>', Role::where('name', 'unconfirmed')->first()->id)
            ->where('role_id', '<>', Role::where('name', 'admin')->first()->id)
            ->get();

            return view('welcome')
                ->with('users', $users);

    }
}
