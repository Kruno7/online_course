<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Http\Request;
use Auth;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Rating;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.courses.index')->with('courses', Course::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create')->with('languages', Language::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'language_id' => 'required',
            'level' => 'required',
            'type' => 'required',
            'min_members' => 'required',
            'max_members' => 'required',
            'type_of_course' => 'required',
            'start_of_the_course' => 'required',
            'end_of_the_course' => 'required',
            'course_content' => 'required',
            'img' => 'required'
        ]);

        if ($request->hasFile('img')) {
            $file = $request->img;
            $filename = $file->getClientOriginalName();
            $file->move('storage/', $filename);

            $course = new Course();
            $course->img = $filename;
            $course->name = $request->input('name');
            $course->language_id = $request->input('language_id');
            $course->level = $request->input('level');
            $course->type = $request->input('type');
            $course->min_members = $request->input('min_members');
            $course->max_members = $request->input('max_members');
            $course->type_of_course   = $request->input('type_of_course');
            $course->start_of_the_course   = $request->input('start_of_the_course');
            $course->end_of_the_course   = $request->input('end_of_the_course');
            $course->course_content   = $request->input('course_content');
           ;
            $course->save();
        }
        return redirect()->route('admin.courses.index')->with('success', 'You have successfully added the course');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit')->with([
            'course' => $course,
            'languages' => Language::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->validate($request, [
            'name' => 'required',
            'language_id' => 'required',
            'level' => 'required',
            'type' => 'required',
            'min_members' => 'required',
            'max_members' => 'required',
            'type_of_course' => 'required',
            'start_of_the_course' => 'required',
            'end_of_the_course' => 'required',
            'course_content' => 'required',
            'img' => 'required'
        ]);

        $course = Course::find($course->id);

        if ($request->hasFile('img')) {

            $file = $request->img;
            $filename = $file->getClientOriginalName();
            $file->move('storage/', $filename);

            $course->img = $filename;
            $course->name = $request->input('name');
            $course->language_id = $request->input('language_id');
            $course->level = $request->input('level');
            $course->type = $request->input('type');
            $course->min_members = $request->input('min_members');
            $course->max_members = $request->input('max_members');
            $course->type_of_course   = $request->input('type_of_course');
            $course->start_of_the_course   = $request->input('start_of_the_course');
            $course->end_of_the_course   = $request->input('end_of_the_course');
            $course->course_content   = $request->input('course_content');
            $course->save();
        }
        return redirect()->route('admin.courses.index')->with('success', 'You have successfully updated the course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Success');
    }


    public function getLessonsByCourseId ($id)
    {
        return view('user.courses.lessons')->with('course', Course::find($id));
    }

    public function getLessonById ($id, $lesson_id)
    {
        return view('lesson')->with('lesson', Lesson::find($lesson_id));
    }
}
