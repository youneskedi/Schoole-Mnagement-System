<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Session;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function index(Session $session)
    {
        $id = $session->id ;

        $lectures = Lecture::where('session_id' , $id)->get();
        return view('student.lectures' , [
            'lectures' => $lectures ,
            'session' => $session
        ]);
    }

}
