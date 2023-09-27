<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $teachers = User::where('role' , 'teacher')->get();
//        @dd($admins);
        return view('teacher.all_teachers' , [
            'teachers' => $teachers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.create');
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
        $validated['role'] = 'teacher' ;

        User::create($validated) ;

        return redirect(route('teacher.index'));
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
        $teacher = User::findOrFail($id) ;
        return view('teacher.edit' , [
            'teacher' => $teacher
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = User::findOrFail($id) ;
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

        $validated['img'] = $teacher->img ;

        $teacher->update($validated) ;

        return redirect(route('teacher.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $teacher)
    {
        $teacher->delete() ;
        return redirect(route('teacher.index')) ;
    }
}
