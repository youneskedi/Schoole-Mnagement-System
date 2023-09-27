@extends('layouts.index')

@section('content')
    <style>
        body {
            background-color: #f4f4f4;
        }

        .attendance-container {
            max-width: 600px;
            margin: auto;
            padding: 40px 30px 30px 30px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .attendance-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .attendance-table th,
        .attendance-table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .attendance-checkbox {
            margin: 0 auto;
        }

        .submit-button {
            display: block;
            margin: 20px auto 0;
        }
    </style>
    <div class="container mt-5">
        <div class="attendance-container">
            <h2 class="attendance-header">Student List</h2>
            <form method="POST" action="{{ route('teacher.add_to_course', $course)}}">
                @csrf
                <table class="attendance-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->name}}</td>
                            <td class="attendance-checkbox">
                                <input name="check[]" type="checkbox" value="{{ $student->id }}">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary submit-button">Submit Adding</button>
            </form>
        </div>
    </div>

@endsection

