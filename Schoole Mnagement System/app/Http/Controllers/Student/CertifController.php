<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertifController extends Controller
{
    public function index(){
        $user = Auth::user() ;
        $certifs = $user->certifs()->wherePivot('is_finished' , true)->get() ;
        return view('student.certif' , [
            'certifs' => $certifs
        ]);
    }
}
