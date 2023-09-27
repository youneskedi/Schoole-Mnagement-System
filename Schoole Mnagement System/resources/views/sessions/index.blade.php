@extends('layouts.index')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="mb-4">
                <button type="button" class="bg-info mb-1 ml-2 rounded p-2">
                    <a style="text-decoration: none" href="{{route('session.create' , $course)}}">Create New Session</a>
                </button>

                <button type="button" class="bg-warning ml-3 mb-1 ml-2 rounded p-2">
                    <a style="text-decoration: none" href="{{route('asignment.create' , $course->id )}}">Create New
                        Asignment</a>
                </button>
            </div>
            </div>

            <div class="card card-default mt-4">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-bullhorn mr-4"></i>
                        <span style="font-size: 25px">{{$course->title}} Path</span>
                    </h2>
                </div>

                @php
                    $arr = [];
                    foreach ($sessions as $session)
                        array_push($arr , $session);

                    foreach ($asignments as $asignment)
                        array_push($arr , $asignment);

                    $sortedData = collect($arr)->sortBy('created_at')->values()->all();
                @endphp

                @foreach($sortedData as $data)

                    @if($data instanceof  \App\Models\Session)
                        @php $session = $data ; @endphp
                        <div class="card-body">
                            <div class="callout callout-info">
                                <h5 class="mb-4">
                                    <a style="text-decoration: none; color: initial;"
                                       href="{{route('lecture.index' , $session)}}" class="text-dark">
                                        <i class="fas fa-angle-double-right ml-2"></i>
                                        {{$session->title}}
                                    </a>
                                </h5>
                                <div>

                                </div>
                                <div class="d-flex">
                                    <button class="bg-info mb-1 ml-2 rounded"><a style="text-decoration: none"
                                                                                 href="{{route('session.edit' , $session)}}">Edit
                                            Session</a></button>
                                    <form action="{{ route('session.destroy', $session) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-danger mb-1 ml-2 rounded">Delete Session
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @elseif($data instanceof \App\Models\Asignment)
                        @php $asignment = $data ; @endphp
                        <div class="card-body">
                            <div class="callout callout-warning">
                                <h5 class="mb-4">
                                    <i class="fas fa-angle-double-right ml-2"></i>
                                    {{$asignment->title}}
                                </h5>
                                @if($asignment->file != null)
                                    @if($asignment->ext == 'zip')
                                        <div class="container mt-5">
                                            @php
                                                $zip = '/uploads/courses/asignments/' . $asignment->file ;
                                                $zipFileName = pathinfo($zip, PATHINFO_FILENAME);
                                            @endphp
                                            <i class="fas fa-file-archive"></i> {{ $zipFileName }}
                                            <a href="{{ $zip }}" class="btn btn-primary m-3">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </div>
                                    @else
                                        @php $photo = '/uploads/courses/asignments/' . $asignment->file ; @endphp
                                        <div class="mb-5 mt-5">
                                            <img width="500" height="300px" src="{{$photo}}" alt="">
                                        </div>
                                    @endif
                                    <div>
                                        <div class="d-flex">
                                            <form action="{{ route('asignment.destroy', $asignment) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit" class="bg-danger mb-1 ml-2 rounded">Delete File
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div>
                                        <form action="{{route('teacher.asignment.update' , $asignment)}}" method="Post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input name="file" type="file" class="custom-file-input"
                                                                   id="file">
                                                            <label class="custom-file-label" for="file">Upload file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                                <div class="mt-3 d-flex">
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
                    @endif
                @endforeach
            </div>
        </div>

        @endsection


        @section('scripts')
            <script src="/index/plugins/jquery/jquery.min.js"></script>
            <script src="/index/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
            <script>
                $(function () {
                    bsCustomFileInput.init();
                });
            </script>
@endsection
