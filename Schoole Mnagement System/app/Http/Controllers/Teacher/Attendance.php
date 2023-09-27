<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Certif;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Attendance extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = $user->courses;
        return view('teacher.attendance_course', [
            'courses' => $courses,
        ]);
    }

    public function show(Course $course)
    {
        $users = $course->users->where('role', 'student');
        $attended_students = [];

        $students = $course->users()->wherePivot('is_attendance', true)->get();
        foreach ($students as $student)
            array_push($attended_students, $student->id);

        return view('teacher.attendance', [
            'students' => $users,
            'attended_students' => $attended_students,
            'course' => $course
        ]);
    }

    public function store(Request $request, Course $course)
    {
        $users = $course->users->where('role', 'student');
        $course->users()->syncWithoutDetaching($users);
        foreach ($users as $user) {
            $course->users()->updateExistingPivot($user->id, ['is_attendance' => false]);
        }
        $students = User::findOrFail($request->checkStu);
        foreach ($students as $student) {
            $course->users()->updateExistingPivot($student->id, ['is_attendance' => true]);
        }

        return redirect(route('attendance.index'));
    }
}
