@extends('layouts.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Courses </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mt-4">
                                @foreach($courses as $course)
                                    <div class="col-sm-4 mb-3" style="background-color: rgba(0,0,0,.03);">
                                        <div class="position-relative">
                                            @php $photo = '/uploads/courses/' . $course->img ; @endphp
                                            <img style="border-radius:5px;  " src="{{$photo}}" width="320" height="250">
                                            <div class="ribbon-wrapper ribbon-lg">
                                            </div>
                                        </div>
                                        <h3 style="display: inline-block" class="m-2">{{$course->title}}</h3>
                                        <p class="m-2">{{$course->desc}}</p>
                                        @php
                                            $users = $course->users;
                                        @endphp
                                        @php $count = 0; @endphp
                                        @foreach($users as $user)
                                            @if($user->role == 'teacher')
                                                <h5 style="display: inline-block" class="m-2">Teacher :</h5>
                                                <span>{{$user->name}}</span>
                                            @endif
                                            @php
                                                if($user->role == 'student')
                                                    $count++ ;
                                            @endphp
                                        @endforeach
                                        <h5 style="display: inline-block" class="ml-2">number of students : </h5>
                                        <span>{{$count}}</span>
                                        <div>
                                            <span style="padding: 3px; margin-left: 80px"
                                                  class="bg-info  mb-1  rounded"><a
                                                        href="{{route('student.session.show' , $course)}}">Go To Course</a></span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
