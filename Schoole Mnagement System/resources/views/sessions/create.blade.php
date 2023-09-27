@extends('layouts.index')

@section('content')
    <form action="{{ route('session.store', $course) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="edit_title">Title:</label>
            <input type="text" class="form-control" id="edit_title" name="title" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Session</button>
    </form>
@endsection
