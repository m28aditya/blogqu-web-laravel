@extends('layouts.main')
@section('content')
<article class="my-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="d-flex me-md-1 my-2" method="GET" action="/">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-primary px-3" type="submit">Search</button>
                </form>
            </div>
        </div>

        @if ($data->isEmpty())
        <h3 class="text-center"><strong>{{ request('search') }}</strong> Has No Result</h3>
        @endif

        @if ($data->isNotEmpty())
        @if (session()->has('filter'))
        <h3>Result for <strong>{{ session('filter') }}</strong></h3>
        @endif
        <div class="card mb-3">
            <img src="{{ asset('storage/'.$data[0]->image)}}" class="card-img-top" height="400"
                alt="{{ $data[0]->slug }}">
            <div class="card-body">
                <h5 class="card-title fw-bold fs-3">{{ $data[0]->title }}</h5>
                <p class="card-text">
                    <small>Written By <a href="/post/author/{{ $data[0]->user->name
                    }}" class="text-decoration-none">{{ $data[0]->user->name
                            }}</a></small>
                    <small class="text-muted text-end">{{ $data[0]->created_at->diffForHumans() }}</small>
                </p>
                <p class="card-text excerpt">
                    {!! Str::words($data[0]->content, 40,'...'.
                    '
            </div>'); !!}
            </p>
            <a href="/post/{{ $data[0]->slug }}" class="btn btn-primary mb-2">Read More</a><br>
            <i class="text-danger bi bi-heart-fill me-1"></i><small>Liked: {{ $data[0]->like->count() }}</small>
            <i class="bi bi-chat-left-dots-fill text-info ms-5 me-1"></i><small>Commented: {{ $data[0]->comment->count()
                }}</small>
        </div>
    </div>
    <div class="row">
        @foreach ($data->skip(1) as $item)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('storage/'.$item->image)}}" height="200" class="card-img-top"
                    alt="{{ $item->slug }}">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $item->title }}</h5>
                    <p class="card-text">
                        <small>Written By <a href="/post/author/{{ $item->user->name
                        }}" class="text-decoration-none">{{ $item->user->name }}</a></small><br>
                        <small class="text-muted text-end">{{ $item->created_at->diffForHumans() }}</small>
                    </p>
                    <p class="card-text excerpt">{!! Str::words($item->content, 20,'...'.'
                </div>'); !!}</p>
                <a href="/post/{{ $item->slug }}" class="btn btn-primary btn-sm mb-2">Read More</a><br>
                <i class="text-danger bi bi-heart-fill me-1"></i><small>Liked: {{ $item->like->count() }}</small>
                <i class="bi bi-chat-left-dots-fill text-info ms-5 me-1"></i><small>{{ $item->comment->count()
                    }}</small>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</article>
@endsection