<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Rating;
use DB;
use Auth;

class CourseController extends Controller
{
    public function rating (Request $request)
    {
        Rating::create($request->all());
        return response()->json(array('message'=> 'Success'), 200);
    }


    public function destroyRating ($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return redirect()->back()->with('success', 'You have successfully deleted your comment');
    }
}
