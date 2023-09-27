@extends('layouts.index')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('course.store2') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="bg-light p-3 mb-3">
                        <h2 class="mb-3">Create Course</h2>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <input type="text" name="desc" class="form-control">
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="bg-light p-3 mb-3">
                        <h2 class="mb-3">Add Student To The Course</h2>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td class="attendance-checkbox">
                                  <input name="checkStu[]" type="checkbox" value="{{ $student->id }}">
                                     </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-light p-3">
                        <h2 class="mb-3">Add Teacher To The Course</h2>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{ $teacher->name }}</td>
                                    <td class="attendance-checkbox">
                                        <input name="checkTech[]" type="checkbox" value="{{ $teacher->id }}"
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary ml-4 mb-4">Create Course</button>
                </div>
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

