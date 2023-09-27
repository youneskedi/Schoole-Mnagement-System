@extends('layouts.index')

@section('title')
    My Profile
@endsection

@section('style')
    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #1871d7
        }

        .profile-button {
            background: #1871d7;
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #4818d7
        }

        .profile-button:focus {
            background: #9ed718;
            box-shadow: none
        }

        .profile-button:active {
            background: #0cfb24;
            box-shadow: none
        }

        .back:hover {
            color: #1871d7;
            cursor: pointer
        }

        .labels {
            font-size: 11px;
        }

        .add-experience:hover {
            background: #010912;
            color: #ffffff;
            cursor: pointer;
            border: solid 1px #871b1b
        }


    </style>
@endsection

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @php $photo = '/uploads/admins/' . $user->img ; @endphp
                    <img class="rounded-circle mt-5" width="150px" src="{{$photo}}">
                    <span class="font-weight-bold">{{$user->name}}</span>
                    <span class="text-black-50">{{$user->email}}</span><span> </span></div>
            </div>
            <div class="col-md-9 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-2">
                        <form action="{{route('student.profile.update' , $user)}}" method="post">
                            @csrf
                            {{--                            @method('PATCH')--}}
                            <div class="row mt-3">
                                <div class="col-md-12 m-2">
                                    <label class="labels">Name</label>
                                    <input name="name" type="text" class="form-control" placeholder="first name"
                                           value="{{$user->name}}">
                                </div>
                                <div class="col-md-12 m-2">
                                    <label class="labels">Mobile Number</label>
                                    <input name="phone_number" type="text" class="form-control"
                                           placeholder="enter phone number" value="{{$user->phone_number}}">
                                </div>
                                <div class="col-md-12 m-2">
                                    <label class="labels">Email ID</label>
                                    <input name="email" type="text" class="form-control" placeholder="enter email id"
                                           value="{{$user->email}}">
                                </div>
                                <div class="col-md-12 m-2">
                                    <label class="labels">PassWord</label>
                                    <input name="password" type="text" class="form-control" placeholder="education"
                                           value="{{$user->password}}">
                                </div>
                            </div>

                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
