@extends('layouts.index')

@section('content')
    <div class="container mt-5">
        <form action="{{ route('teacher.course.update', $course) }}" method="get" enctype="multipart/form-data">
            @csrf
            <div class="get">
                <div class="col-md-12">
                    <div class="bg-light p-3 mb-3">
                        <h2 class="mb-3">Manage Student List</h2>
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
                                    <td>
                                        <input name="checkStu[]" type="checkbox" value="{{ $student->id }}"
                                               @if(in_array($student->id, $selectedStudentIds)) checked @endif>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary ml-4 mb-4">Update</button>
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
