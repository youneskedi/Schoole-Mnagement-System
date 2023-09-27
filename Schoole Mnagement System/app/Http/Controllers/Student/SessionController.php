<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Asignment;
use App\Models\Course;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function show(Course $course)
    {
        $id = $course->id ;
        $asignments = Asignment::where('course_id', $id)->get();
        $sessions = Session::where('course_id' , $id)->get();
        return view('student.sessions' , [
            'sessions' => $sessions ,
            'course' => $course ,
            'asignments' => $asignments,
        ]);
    }
}
