<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certif;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CertifController extends Controller
{
    public function index()
    {

        $courses = Course::all();
        return view('admin.certif_courses', [
            'courses' => $courses,
        ]);
    }

    public function show(Course $course)
    {
        $certif = $course->certif;
        $users = $course->users->where('role', 'student');
        $finished_students = [];
        if ($certif)
        {
            $students = $certif->users()->wherePivot('is_finished', true)->get();
            foreach ($students as $student)
                array_push($finished_students , $student->id);
        }

        return view('admin.certif', [
            'students' => $users,
            'finished_student' => $finished_students,
            'certif' => $certif,
            'course' => $course
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $certif = $course->certif;
        if ($certif) {
            $users = $course->users->where('role','student') ;
            $certif->users()->syncWithoutDetaching($users);
            foreach ($users as $user){
                $certif->users()->updateExistingPivot($user->id , ['is_finished' => false]);
            }
            $students = User::findOrFail($request->checkStu);
            foreach ($students as $student) {
                $certif->users()->updateExistingPivot($student->id, ['is_finished' => true]);
            }
        }

        return redirect(route('certif.index'));
    }

    public function store2(Request $request, Course $course)
    {

        $files = $request->file('img');
        $files_extension = $files->getClientOriginalExtension();

        $file_name = time() . '.' . $files_extension;
        $path = 'uploads/courses';
        $files->move($path, $file_name);

        $validated['title'] = $request->title;
        $validated['course_id'] = $course->id;
        $validated['img'] = $file_name;
        Certif::create($validated);

        return redirect(route('certif.index'));
    }

    public function update(Request $request, Certif $certif)
    {
        $files = $request->file('img');
        $files_extension = $files->getClientOriginalExtension();

        $file_name = time() . '.' . $files_extension;
        $path = 'uploads/courses';
        $files->move($path, $file_name);

        $validated['title'] = $request->title;
        $validated['course_id'] = $certif->course_id;
        $validated['img'] = $file_name;

        $certif->update($validated);

        return redirect(route('certif.index'));
    }

}
