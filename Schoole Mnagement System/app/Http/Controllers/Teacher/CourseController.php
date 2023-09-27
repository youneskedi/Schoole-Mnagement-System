<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user() ;
        $courses = $user->courses ;
        return view('teacher.courses' , [
            'courses' => $courses ,
        ]);
    }

    public function addStudentToCourse(Course $course)
    {
        $users = $course->users()->where('role', 'student')->get();
        $ids = [];
        foreach ($users as $user) {
            array_push($ids, $user->id);
        }

        $students = User::where('role', 'student')
            ->whereNotIn('id', $ids)->get();

        return view('teacher.add_students', [
            'students' => $students,
            'course' => $course
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $ids = $request->check;
//        $students = User::whereIn('id' , $ids)->get();
        $course->users()->syncWithoutDetaching($ids);

        return redirect(route('teacher.course.index'));
    }


    public function edit(Course $course)
    {
        $users = $course->users()->where('role', 'student')->get();
        $allUsers = User::where('role' , 'student')->get();
        $ids1 = [];
        foreach ($users as $user) {
            array_push($ids1, $user->id);
        }
        $course->users()->detach($ids1);

        return view('teacher.editCourse', [
            'course' => $course,
            'selectedStudentIds' => $ids1,
            'students' => $allUsers ,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $students = $request->checkStu ;

        if($students != null)
            $course->users()->syncWithoutDetaching($students) ;

        return redirect(route('teacher.course.index'));
    }
}
