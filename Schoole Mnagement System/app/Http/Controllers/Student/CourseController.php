<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function show()
    {

        $user = Auth::user() ;
        $courses = $user->courses ;
        return view('student.courses' , [
            'courses' => $courses ,
        ]);
    }

}
