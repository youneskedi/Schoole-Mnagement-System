<?php

namespace App\Http\Controllers;

use App\Models\Asignment;
use App\Models\Course;
use App\Models\Session;
use Couchbase\S3ExternalAnalyticsLink;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $id = $course->id ;
        $asignments = Asignment::where('course_id', $id)->get();
        $sessions = Session::where('course_id' , $id)->get();
        return view('sessions.index' , [
            'sessions' => $sessions ,
            'course' => $course ,
            'asignments' => $asignments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('sessions.create' , [
            'course' => $course ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Course $course)
    {
         $session = Session::create([
             'title' => $request->title  ,
             'course_id' => $course->id
         ]);

         $course = $session->course ;

         return redirect(route('teacher.session.show' , $course));
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        return view('sessions.edit' , [
            'session' => $session
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Session $session)
    {
        $session->update([
            'title' => $request->title  ,
            'course_id' => $request->course_id
        ]);

        $course = $session->course ;

        return redirect(route('session.index' , $course));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $course = $session->course;
        $session->delete();
        return redirect(route('session.index' , $course));
    }
}
