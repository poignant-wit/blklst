<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class AdminController extends Controller
{
    public function index(){

        if (Auth::user()->hasRole('admin')){
            return view('admin.main');
        }
        return redirect()->route('home');
    }

}
