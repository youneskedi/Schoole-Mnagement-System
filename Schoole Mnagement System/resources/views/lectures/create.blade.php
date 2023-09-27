@extends('layouts.index')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Lecture</h3>
        </div>

        <form action="{{route('lecture.store' , $id)}}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="title">title</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="Enter Title">
                </div>

                <div class="form-group">
                    <label for="desc">Description</label>
                    <input name="desc" type="text" class="form-control" id="desc" placeholder="Enter Description">
                </div>

                <div class="form-group">
                    <label for="file">Upload Video</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="video" type="file" class="custom-file-input" id="video">
                            <label class="custom-file-label" for="video">Choose file</label>
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
