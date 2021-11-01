@extends('layouts.main')
@section('content')
<article class="my-3">
    <div class="container">
        <a href="/" class="btn btn-primary mb-2"><i class="bi bi-arrow-left-circle me-2"></i>Back</a>
        <div class="card mb-3">
            <img src="{{ asset('storage/'.$data->image) }}" class="card-img-top" alt="{{ $data->slug }}" height="600">
            <div class="card-body">
                <div class="row g-0">
                    <div class="col-md-11">
                        <h5 class="card-title fw-bold fs-3">{{ $data->title }}</h5>
                    </div>
                    <div class="col-md-1">
                        @if (empty($liked))
                        <form action="/post/{{ $data->slug }}/unlike" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger"><i
                                    class="bi bi-heart-fill"></i></button>
                        </form>
                        @endif
                        @if (!empty($liked))
                        <form action="/post/{{ $data->slug }}/like" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary"><i
                                    class="bi bi-heart-fill"></i></button>
                        </form>
                        @endif
                    </div>
                </div>
                <p class="card-text">
                    <small>Written By <a href="#" class="text-decoration-none">{{ $data->user->name }}</a></small>
                    <small class="text-muted">{{ $data->created_at->diffForHumans() }}</small>
                </p>
                <p class="card-text">{!! $data->content !!}
                </p>
                <i class="text-danger bi bi-heart-fill me-1"></i>{{ $data->like->count() }}
                <i class="bi bi-chat-left-dots-fill text-info ms-5 me-1"></i>{{ $data->comment->count() }}
            </div>
        </div>

        <h4>Komentar</h4>
        <hr>
        @foreach ($comments as $comment)
        <div class="card mb-3">
            <div class="card-header">{{ $comment->user->name }}</div>
            <div class="card-body">
                <p class="card-text">{{ $comment->comment }}</p>
            </div>
        </div>
        @endforeach
        <form method="post" action="/post/{{ $data->slug }}/comment">
            @csrf
            <div class="mb-3 comment">

                <label for="comment" class="form-label fs-5">Beri Komentar</label>
                <textarea name="comment" id="comment"
                    class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                @error('comment')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</article>
@endsection