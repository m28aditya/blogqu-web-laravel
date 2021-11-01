@extends('layouts.main')
@section('content')
<article>
    <div class="container mt-3">
        <a href="/create/post" class="my-2 btn btn-success"><i class="bi bi-pencil-fill me-2"></i>Buat Artikel</a>

        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <table class="table table-striped table-bordered text-center">
            <thead>
                <th>No</th>
                <th>Judul Artikel</th>
                <th>Tanggal Buat</th>
                <th>#</th>
            </thead>
            <tbody>
                @if ($data->isEmpty())
                <tr>
                    <td colspan="4">
                        <h1 class="text-center"><i>No Result</i></h1>
                    </td>
                </tr>
                @endif
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="/detail/post/{{ $item->id }}" class="btn btn-outline-primary btn-sm"><i
                                class="bi bi-eye-fill me-2"></i>Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</article>
@endsection