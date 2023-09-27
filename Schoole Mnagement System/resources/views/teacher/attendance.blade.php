@extends('layouts.index')

@section('styles')
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

        #checklist {
            --background: #fff;
            --text: #414856;
            --check: #4f29f0;
            --disabled: #c3c8de;
            --width: auto;
            --height: auto;
            --border-radius: 10px;
            background: var(--background);
            width: var(--width);
            height: var(--height);
            border-radius: var(--border-radius);
            position: relative;
            box-shadow: 0 10px 30px rgba(65, 72, 86, 0.05);
            padding: 30px 85px;
            display: grid;
            grid-template-columns: 30px auto;
            align-items: center;
            justify-content: center;
        }

        #checklist label {
            color: var(--text);
            position: relative;
            cursor: pointer;
            display: grid;
            align-items: center;
            width: fit-content;
            transition: color 0.3s ease;
            margin-right: 20px;
        }

        #checklist label::before, #checklist label::after {
            content: "";
            position: absolute;
        }

        #checklist label::before {
            height: 2px;
            width: 8px;
            left: -27px;
            background: var(--check);
            border-radius: 2px;
            transition: background 0.3s ease;
        }

        #checklist label:after {
            height: 4px;
            width: 4px;
            top: 8px;
            left: -25px;
            border-radius: 50%;
        }

        #checklist input[type="checkbox"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
            height: 15px;
            width: 15px;
            outline: none;
            border: 0;
            margin: 0 15px 0 0;
            cursor: pointer;
            background: var(--background);
            display: grid;
            align-items: center;
            margin-right: 20px;
        }

        #checklist input[type="checkbox"]::before, #checklist input[type="checkbox"]::after {
            content: "";
            position: absolute;
            height: 2px;
            top: auto;
            background: var(--check);
            border-radius: 2px;
        }

        #checklist input[type="checkbox"]::before {
            width: 0px;
            right: 60%;
            transform-origin: right bottom;
        }

        #checklist input[type="checkbox"]::after {
            width: 0px;
            left: 40%;
            transform-origin: left bottom;
        }

        #checklist input[type="checkbox"]:checked::before {
            animation: check-01 0.4s ease forwards;
        }

        #checklist input[type="checkbox"]:checked::after {
            animation: check-02 0.4s ease forwards;
        }

        #checklist input[type="checkbox"]:checked + label {
            color: var(--disabled);
            animation: move 0.3s ease 0.1s forwards;
        }

        #checklist input[type="checkbox"]:checked + label::before {
            background: var(--disabled);
            animation: slice 0.4s ease forwards;
        }

        #checklist input[type="checkbox"]:checked + label::after {
            animation: firework 0.5s ease forwards 0.1s;
        }

        @keyframes move {
            50% {
                padding-left: 8px;
                padding-right: 0px;
            }

            100% {
                padding-right: 4px;
            }
        }

        @keyframes slice {
            60% {
                width: 100%;
                left: 4px;
            }

            100% {
                width: 100%;
                left: -2px;
                padding-left: 0;
            }
        }

        @keyframes check-01 {
            0% {
                width: 4px;
                top: auto;
                transform: rotate(0);
            }

            50% {
                width: 0px;
                top: auto;
                transform: rotate(0);
            }

            51% {
                width: 0px;
                top: 8px;
                transform: rotate(45deg);
            }

            100% {
                width: 5px;
                top: 8px;
                transform: rotate(45deg);
            }
        }

        @keyframes check-02 {
            0% {
                width: 4px;
                top: auto;
                transform: rotate(0);
            }

            50% {
                width: 0px;
                top: auto;
                transform: rotate(0);
            }

            51% {
                width: 0px;
                top: 8px;
                transform: rotate(-45deg);
            }

            100% {
                width: 10px;
                top: 8px;
                transform: rotate(-45deg);
            }
        }

        @keyframes firework {
            0% {
                opacity: 1;
                box-shadow: 0 0 0 -2px #4f29f0, 0 0 0 -2px #4f29f0, 0 0 0 -2px #4f29f0, 0 0 0 -2px #4f29f0, 0 0 0 -2px #4f29f0, 0 0 0 -2px #4f29f0;
            }

            30% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                box-shadow: 0 -15px 0 0px #4f29f0, 14px -8px 0 0px #4f29f0, 14px 8px 0 0px #4f29f0, 0 15px 0 0px #4f29f0, -14px 8px 0 0px #4f29f0, -14px -8px 0 0px #4f29f0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="bg-light p-3 mb-3">
                <h2 class="mb-3">Manage Certificates List</h2>
                <form action="{{route('teacher.attendance.store' , $course)}}" method="post">
                    @csrf
                    @method('get')
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
                                    <div id="checklist">
                                        <input value="{{$student->id}}" name="checkStu[]" type="checkbox" id="{{ $student->id }}"
                                               @if(in_array($student->id, $attended_students)) checked @endif>
                                        <label for="{{ $student->id }}">Add Student</label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
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

