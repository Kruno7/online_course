<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;


class ProfileController extends Controller
{

    public function index () 
    {
        $user = User::find(Auth::user()->id);
        $results = DB::table('student_results')->where('user_id', Auth::user()->id)->get();
        return view('user.profile.index')->with([
            'user' => $user,
            'results' => $results
        ]);
    }
}
