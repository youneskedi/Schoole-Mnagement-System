@extends('layouts.index')
@section('content')
    @foreach($certifs as $certif)
        @php
            $course = $certif->course ;
            $photo = '/uploads/courses/' . $certif->img ;
        @endphp

        <h1>{{$course->title}}'s Certificates</h1>
        <br>
        <h2>{{$certif->title}}</h2>
        <img src="{{$photo}}" alt="">

    @endforeach
@endsection
