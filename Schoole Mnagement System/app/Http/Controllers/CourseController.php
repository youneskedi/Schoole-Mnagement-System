<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();

        return (view('courses.courses', [
            'courses' => $courses
        ]));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allUsers = User::where('role' , 'student')->get();
        $allTeachers = User::where('role' , 'teacher')->get();

        return view('courses.create', [
            'students' => $allUsers ,
            'teachers' => $allTeachers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $ids = $request->check;
//        $students = User::whereIn('id' , $ids)->get();
        $course->users()->syncWithoutDetaching($ids);

        return redirect(route('course.index'));
    }

    public function  store2(Request $request)
    {
        $files = $request->file('img');
        $files_extension = 'png';

        $file_name = time() . '.' . $files_extension ;
        $path = 'uploads/courses' ;
        $files->move($path , $file_name) ;

        $validated = $request->validate([
            'title' => 'string|required' ,
            'desc' => 'required' ,
            'img' => 'nullable'
        ]);

        $validated['img'] = $file_name ;
        $course = Course::create($validated) ;

        $students = $request->checkStu ;
        $teachers = $request->checkTech;

        if($students != null)
            $course->users()->syncWithoutDetaching($students) ;
        if($teachers != null)
            $course->users()->syncWithoutDetaching($teachers) ;

        return redirect(route('course.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $users = $course->users()->where('role', 'student')->get();
        $ids = [];
        foreach ($users as $user) {
            array_push($ids, $user->id);
        }

        $students = User::where('role', 'student')
            ->whereNotIn('id', $ids)->get();

        return view('courses.add_students', [
            'students' => $students,
            'course' => $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $users = $course->users()->where('role', 'student')->get();
        $allUsers = User::where('role' , 'student')->get();
        $teachers = $course->users()->where('role' , 'teacher')->get();
        $allTeachers = User::where('role' , 'teacher')->get();
        $ids1 = [];
        foreach ($users as $user) {
            array_push($ids1, $user->id);
        }

        $ids2 = [];
        foreach ($teachers as $teacher) {
            array_push($ids2, $teacher->id);
        }

        return view('courses.edit', [
            'course' => $course,
            'selectedStudentIds' => $ids1,
            'students' => $allUsers ,
            'selectedTeacherIds' => $ids2 ,
            'teachers' => $allTeachers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $users = $course->users()->where('role', 'student')->get();
        $teachers = $course->users()->where('role' , 'teacher')->get();

        $ids1 = [];
        foreach ($users as $user) {
            array_push($ids1, $user->id);
        }

        $ids2 = [];
        foreach ($teachers as $teacher) {
            array_push($ids2, $teacher->id);
        }

        $course->users()->detach($ids1);

        $course->users()->detach($ids2);

        $students = $request->checkStu ;
        $teachers = $request->checkTech;

        if($students != null)
          $course->users()->syncWithoutDetaching($students) ;
        if($teachers != null)
          $course->users()->syncWithoutDetaching($teachers) ;

        $validated = $request->validate([
            'title' => 'string|max:50' ,
            'desc' => 'string'
        ]);

        $course->update([
            'title' => $validated['title']  ,
            'desc' => $validated['desc']
        ]);
        return redirect(route('course.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect(route('course.index'));
    }
}
