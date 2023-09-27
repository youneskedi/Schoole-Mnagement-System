@extends('layouts.index')

@section('content')
    <div class="row">
        <div class="col-md-6 mb-4">
            @php $id = $course->id @endphp
            <div class="mb-4">
                <button type="button" class="bg-info mb-1 ml-2 rounded p-2">
                    <a style="text-decoration: none" href="{{route('asignment.create' , $id )}}">Create New
                        Asignment</a>
                </button>
            </div>

            <div class="card card-default mt-4">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-bullhorn mr-4"></i>
                        <span style="font-size: 25px">{{$course->title}} Asignments</span>
                    </h2>
                </div>

                @foreach($asignments as $asignment)
                    <div class="card-body">
                        <div class="callout callout-info">
                            <h5 class="mb-4">
                                <a style="text-decoration: none; color: initial;"
                                   href="{{route('asignment.index' , $asignment)}}" class="text-dark">
                                    <i class="fas fa-angle-double-right ml-2"></i>
                                    {{$asignment->title}}
                                </a>
                            </h5>
{{--                            @if($asignment->file->getClientOriginalExtension() == 'zip')--}}
{{--                                @php echo 'hello world' ; @endphp--}}
{{--                            @else--}}
                                @php $photo = '/uploads/courses/asignments/' . $asignment->file ; @endphp
                                <div class="mb-5 mt-5">
                                    {{--                        <img width="1000px" height="600px" src="{{$photo}}" alt="">--}}
                                    <video width="500" height="300px" controls>
                                        <source src="{{$photo}}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>

                                </div>
{{--                            @endif--}}
                            <div>
                                <div class="d-flex">
                                    <button class="bg-info mb-1 ml-2 rounded"><a style="text-decoration: none"
                                                                                 href="{{route('asignment.edit' , $asignment)}}">Edit
                                            asignment</a></button>
                                    <form action="{{ route('asignment.destroy', $asignment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-danger mb-1 ml-2 rounded">Delete Asignment
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection
