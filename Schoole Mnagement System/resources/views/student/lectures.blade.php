@extends('layouts.index')
`
@section('content')
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
                        <video width="1000px" height="600px" controls>
                            <source src="{{$photo}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                    </div>
                </div>
            </div>
        @endforeach
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

