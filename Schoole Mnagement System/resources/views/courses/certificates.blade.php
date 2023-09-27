@extends('layouts.index')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Courses Certificates</h3>
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
                                        <span style="padding: 3px; margin-left: 80px" class="bg-info  mb-1  rounded"><a href="{{route('session.index' , $course)}}">Go To Course</a></span>
                                        <span style="padding: 3px; margin-left: 80px" class="bg-info  mb-1  rounded"><a href="{{route('asignment.index' , $course)}}">Go To Asignments</a></span>

                                        <p class="m-2">{{$course->desc}}</p>
                                        @php
                                            $users = $course->users;
                                        @endphp
                                        @php $count = 0; @endphp
                                        @foreach($users as $user)
                                            @if($user->role == 'teacher')
                                                <h5 style="display: inline-block" class="m-2">Teacher :</h5> <span>{{$user->name}}</span>
                                            @endif
                                            @php
                                                if($user->role == 'student')
                                                    $count++ ;
                                            @endphp
                                        @endforeach
                                        <h5 style="display: inline-block" class="ml-2">number of students : </h5> <span>{{$count}}</span>
                                        <div class="container mt-4 mb-4">
                                            <div class="d-flex">
                                                <a href="{{route('course.show' , $course)}}" class="btn btn-primary mr-3 ml-3">Add Student</a>
                                                <a href="{{route('course.edit' , $course)}}" class="btn btn-secondary mr-3">Edit Course</a>
                                                <br>
                                            </div>
                                            <div>
                                                <form action="{{ route('course.destroy', $course) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button style="margin-left: 70px" type="submit" class="btn btn-danger mt-3">Delete Course</button>
                                                </form>
                                            </div>
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
