<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Asignment;
use Illuminate\Http\Request;

class AsignmentController extends Controller
{
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

        return redirect(route('student.session.show' , $course));
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

        return redirect(route('student.session.show' , $course));
    }

    public function update2(Request $request, Asignment $asignment)
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

        return redirect(route('student.session.show' , $course));
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

        return redirect(route('student.session.show' , $course));
    }

}
