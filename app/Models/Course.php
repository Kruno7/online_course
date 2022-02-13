<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'level',
        'type',
        'min_members',
        'max_members',
        'type_of_course',
        'start_of_the_course',
        'end_of_the_course',
        'course_content',
        'img',
        'language_id',
    ];

    public function lessons ()
    {
        return $this->hasMany(Lesson::class);
    }


    public function student_courses ()
    {
        return $this->belongsToMany(User::class, 'student_courses');
    }

    public function ratings ()
    {
        return $this->hasMany(Rating::class);
    }

    public function users ()
    {
        return $this->hasMany(User::class);
    }
    
}
