@extends('layouts.index')
`
@section('content')
    @php $id = $session->id @endphp
    <div class="mb-4">
        <button type="button"  class="bg-info mb-1 ml-2 rounded p-2">
            <a style="text-decoration: none" href="{{route('lecture.create' , $id )}}">Create New Lecture</a>
        </button>
    </div>

    <div class="card card-default">
        <div class="card-header">
            <h2 class="card-title">
                <i class="fas fa-bullhorn mr-4"></i>
                <span style="font-size: 25px">{{$session->title}}</span>
            </h2>
        </div>
        <!-- /.card-header -->

        @foreach($lectures as $lecture)
            <div class="card-body">
                <div class="callout callout-info">
                    <h5 class="mb-4">
                            {{$lecture->title}}
                    </h5>
                    <div>
                        {{$lecture->desc}}
                    </div>
                    @php $photo = '/uploads/courses/lectures/' . $lecture->video ; @endphp
                    <div class="mb-5 mt-5">
{{--                        <img width="1000px" height="600px" src="{{$photo}}" alt="">--}}
                        <video width="1000px" height="600px"  controls>
                            <source src="{{$photo}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                    </div>
                    <div>
                        <div class="d-flex">
                            <button class="bg-info mb-1 ml-2  rounded"><a style="text-decoration: none" href="{{route('lecture.edit' , $lecture)}}">Edit Lecture</a></button>
                            <form action="{{ route('lecture.destroy', $lecture) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-danger mb-1 ml-2 rounded">Delete Lecture</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

