@extends('welcome')

@section('content')
    <div class="py-5 mb-3 ms-4">
        <!-- print success message after file upload  -->
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
            </div>
        @endif
        <h4>File Upload</h4>
        <form action="{{ route('upload.csv') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-auto">
                <label for="formFileMultiple" class="visually-hidden">Multiple files input example</label>
                <input class="form-control" type="file" name="filenames[]" multiple>
                @if ($errors->has('filenames'))
                    <span class="help-block text-danger">{{ $errors->first('filenames') }}</span>
                @endif
            </div>
            <div class="col-auto">
                <button type="submit" name="import" class="btn btn-primary mb-3">Upload</button>
            </div>
        </form>
    </div>
@endsection
