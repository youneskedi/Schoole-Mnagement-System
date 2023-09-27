@extends('layouts.index')

@section('content')
    <form action="{{ route('session.update', $session) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="edit_title">Title:</label>
            <input type="text" class="form-control" id="edit_title" value="{{$session->title}}" name="title" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
@endsection
