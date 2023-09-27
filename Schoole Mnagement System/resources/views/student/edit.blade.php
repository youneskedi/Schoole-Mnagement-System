@extends('layouts.index')

@section('content')

    <form action="{{ route('student.update', $student) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $student->name }}">
        </div>
        <div class="form-group">
            <label for="phone_number">Parent Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $student->phone_number }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $student->email }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" value="{{ $student->password }}">
        </div>
        <div class="form-group">
            <label for="img">Upload Image</label>
            <div class="custom-file">
                <input name="img" type="file" class="custom-file-input" id="file" value="{{$student->img}}">
                <label  class="custom-file-label" for="file" >{{$student->img}}</label>
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
