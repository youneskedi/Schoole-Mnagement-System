@extends('layouts.index')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Teacher</h3>
        </div>

        <form action="{{route('teacher.store')}}" method="Post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input name="phone_number" type="text" class="form-control" id="phone" placeholder="Enter Phone Number">
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="file">Upload Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="img" type="file" class="custom-file-input" id="file">
                            <label class="custom-file-label" for="file">Choose file</label>
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
