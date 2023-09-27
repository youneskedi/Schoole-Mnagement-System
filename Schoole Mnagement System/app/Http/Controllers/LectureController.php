<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use App\Models\Session;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Session $session)
    {
        $id = $session->id ;

        $lectures = Lecture::where('session_id' , $id)->get();
        return view('lectures.index' , [
            'lectures' => $lectures ,
            'session' => $session
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('lectures.create' , [
            'id' => $id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , string $id)
    {
        $files = $request->file('video');
        $files_extension = 'mp4';

        $file_name = time() . '.' . $files_extension ;
        $path = public_path('uploads/courses/lectures')  ;
        $files->move($path , $file_name) ;

        $validated = $request->validate([
            'title' => 'string|required' ,
            'desc' => 'required' ,
            'video' => 'nullable'
        ]);

        $validated['video'] = $file_name ;
        $validated['session_id'] = $id ;

        $lecture = Lecture::create($validated) ;

        $session = $lecture->session ;

        return redirect(route('lecture.index' , $session));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lecture $lecture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lecture $lecture)
    {
        return view('lectures.edit' , [
            'lecture' => $lecture
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lecture $lecture)
    {
        if($request->hasFile('video')){
            $files = $request->file('video');
            $file_name = time() . '.mp4' ;
            $path = '/uploads/courses/lectures' ;
            $files->move($path , $file_name) ;
        }

        $validated = $request->validate([
            'title' => 'string|required' ,
            'desc' => 'nullable' ,
            'video' => 'nullable'
        ]);

        $validated['video'] = $lecture->video ;

        $lecture->update($validated) ;

        $session = $lecture->session ;

        return redirect(route('lecture.index' , $session));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lecture $lecture)
    {
        $session = $lecture->session;
        $lecture->delete();
        return redirect(route('lecture.index' , $session));
    }
}
