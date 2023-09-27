@extends('layouts.index')

@section('content')

    <form action="{{ route('teacher.update', $teacher) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $teacher->name }}">
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $teacher->phone_number }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $teacher->email }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" value="{{ $teacher->password }}">
        </div>
        <div class="form-group">
            <label for="img">Upload Image</label>
            <div class="custom-file">
                <input name="img" type="file" class="custom-file-input" id="file" value="{{$teacher->img}}">
                <label  class="custom-file-label" for="file" >{{$teacher->img}}</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
