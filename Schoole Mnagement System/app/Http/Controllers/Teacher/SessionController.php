<?php

namespace App\Http\Controllers\Teacher;

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
        return view('teacher.sessions' , [
            'sessions' => $sessions ,
            'course' => $course ,
            'asignments' => $asignments,
        ]);
    }

    public function destroy(Request $request, Asignment $asignment)
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

        return redirect(route('teacher.session.show' , $course));
    }

    public function update(Request $request, Asignment $asignment)
    {
        $files = $request->file('file');
        $files_extension = $files->getClientOriginalExtension();

        $file_name = time() . '.' . $files_extension;
        $path = public_path('uploads/courses/asignments');
        $files->move($path, $file_name);

        $validated = $request->validate([
            'file' => 'nullable',
        ]);
        $validated['title'] = $asignment->title ;
        $validated['desc'] = $asignment->desc ;
        $validated['course_id'] = $asignment->course_id ;
        $validated['file'] = $file_name;
        $validated['ext'] = $files_extension;

        $asignment->update($validated) ;

        $course = $asignment->course ;

        return redirect(route('teacher.session.show' , $course));
    }
}
