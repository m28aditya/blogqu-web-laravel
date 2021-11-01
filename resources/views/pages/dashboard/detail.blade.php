@extends('layouts.main')
@section('content')
<article>
    <div class="container mt-3">
        <a href="/dashboard" class="btn btn-primary"><i class="bi bi-arrow-left-circle me-2"></i>Back</a>
        <div class="card my-3">
            <div class="container my-2">
                <form action="/detail/post/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Artikel</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{ $data->title }}"
                            autofocus>
                        @error('title')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Heading</label><br>
                        <img src="{{ asset('storage/'.$data->image) }}" alt="{{ $data->slug }}" class="img-fluid mb-2">
                        <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input id="content" type="hidden" name="content" value="{{ $data->content }}">
                        <trix-editor input="content"></trix-editor>
                        @error('content')
                        <small class="invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-outline-success px-5 py-2">Update</button>
                </form>
                <form action="/delete/post/{{ $data->id }}" method="post" class="ms-2">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger py-2 text-end">Delete</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</article>
@endsection