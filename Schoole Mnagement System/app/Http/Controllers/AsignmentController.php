<?php

namespace App\Http\Controllers;

use App\Models\Asignment;
use App\Models\Course;
use App\Models\Session;
use Illuminate\Http\Request;

class AsignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('asignments.create', [
            'id' => $id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        if($request->hasFile('file'))
        {
            $files = $request->file('file');
            $files_extension = $files->getClientOriginalExtension();


            $file_name = time() . '.' . $files_extension;
            $path = public_path('uploads/courses/asignments');
            $files->move($path, $file_name);
        }


        $validated = $request->validate([
            'title' => 'string|required',
            'desc' => 'required',
            'file' => 'nullable',
        ]);

        if($request->hasFile('file')){
            $validated['file'] = $file_name;
            $validated['ext'] = $files_extension;
        }
        $validated['course_id'] = $id;


        $asignment = Asignment::create($validated);

        $course = $asignment->course;

        $asignments = Asignment::where('course_id', $course->id)->get();
        $sessions = Session::where('course_id' , $course->id)->get();

        return view('teacher.sessions' , [
            'sessions' => $sessions ,
            'course' => $course ,
            'asignments' => $asignments,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignment $asignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignment $asignment)
    {
        return view('asignments.edit', [
            'asignment' => $asignment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignment $asignment)
    {
        if($request->hasFile('file')){
            $files = $request->file('file');
            $file_name = time() . '.mp4' ;
            $path = '/uploads/courses/asignments' ;
            $files->move($path , $file_name) ;
        }

        $validated = $request->validate([
            'title' => 'string|required' ,
            'desc' => 'nullable' ,
            'file' => 'nullable'
        ]);

        $validated['file'] = $asignment->file ;

        $asignment->update($validated) ;

        $course = $asignment->course ;

        $asignments = Asignment::where('course_id', $course->id)->get();
        $sessions = Session::where('course_id' ,$course->id)->get();

        return view('teacher.sessions' , [
            'sessions' => $sessions ,
            'course' => $course ,
            'asignments' => $asignments,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asignment $asignment)
    {
        $course = $asignment->course ;
        $asignment->delete();
        $asignments = Asignment::where('course_id', $course->id)->get();
        $sessions = Session::where('course_id' , $course->id)->get();

        return view('teacher.sessions' , [
            'sessions' => $sessions ,
            'course' => $course ,
            'asignments' => $asignments,
        ]);
    }


    public function destroy2(Request $request, Asignment $asignment)
    {
        $validated = $request->validate([
            'file' => 'nullable',
        ]);
        $validated['title'] = $asignment->title ;
        $validated['desc'] = $asignment->desc ;
        $validated['course_id'] = $asignment->course_id ;
        $validated['file'] = null;
        $validated['ext'] = null;

        $asignment->update($validated) ;

        $course = $asignment->course ;

        return redirect(route('session.index' , $course));
    }
}
