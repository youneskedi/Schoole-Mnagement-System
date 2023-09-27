<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role' , 'student')->get();
//        @dd($admins);
        return view('student.all_students' , [
            'students' => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $files = $request->file('img');
        $files_extension = 'png';

        $file_name = time() . '.' . $files_extension ;
        $path = 'uploads/admins' ;
        $files->move($path , $file_name) ;


        $validated = $request->validate([
            'name' => 'string|required' ,
            'phone_number' => 'required' ,
            'email' => 'email|required' ,
            'password' => 'min:5|required|string' ,
            'img' => 'nullable'
        ]);

        $validated['img'] = $file_name ;
        $validated['role'] = 'student' ;


        User::create($validated) ;

        return redirect(route('student.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = User::findOrFail($id) ;
        return view('student.edit' , [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = User::findOrFail($id) ;
        if($request->hasFile('img')){
            $files = $request->file('img');
            $file_name = time() . '.png' ;
            $path = 'uploads/admins' ;
            $files->move($path , $file_name) ;
        }

        $validated = $request->validate([
            'name' => 'string|required' ,
            'phone_number' => 'required' ,
            'email' => 'email|required' ,
            'password' => 'min:5|required|string' ,
            'img' => 'nullable'
        ]);

        $validated['img'] = $student->img ;

        $student->update($validated) ;

        return redirect(route('student.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        $student->delete() ;
        return redirect(route('student.index')) ;
    }
}
