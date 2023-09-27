<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user() ;
        return view('student.profile' , [
            'user' => $user ,
        ]);
    }

    public function update(Request $request , User $user){
        $validated = $request->validate([
            'name' => 'string' ,
            'phone_number' => 'nullable' ,
            'email' => 'required' ,
            'password' => 'string' ,
        ]);

        $user->update($validated) ;
        return redirect(route('student.profile.index'));
    }
}
