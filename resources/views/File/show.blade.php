<!-- resources/views/File/insert.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Your form goes here -->

        <form action="{{ route('mapAndModifyFile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Choose File:</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload and Modify</button>
        </form>

        <!-- Add the following download button -->
        @if(isset($downloadLink))
            <a href="{{ $downloadLink }}" class="btn btn-success" download>Download Modified File</a>
        @endif
    </div>
@endsection
