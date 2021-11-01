@extends('auth.layouts.main')
@section('content')
<main class="form-signin">
    <form action="/auth/sign-in" method="POST">
        @csrf
        <h1 class="fw-bold text-white bg-danger rounded py-2">BlogQu</h1>
        @if (session()->has('loginFailed'))
        <div class="alert alert-danger" role="alert">
            {{ session('loginFailed') }}
        </div>
        @endif
        @if (session()->has('loginSuccess'))
        <div class="alert alert-success" role="alert">
            {{ session('loginSuccess') }}
        </div>
        @endif

        <div class="form-floating mb-2">
            <input type="email" class="form-control @error('email')is-invalid @enderror" placeholder="name@example.com"
                autofocus name="email">
            <label for="email">Email address</label>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating">
            <input type="password" class="form-control @error('password')is-invalid @enderror" placeholder="Password"
                name="password">
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button class="w-100 btn btn-lg btn-outline-success" type="submit">Sign in</button>
    </form>
    <label class="mt-3">Didn't have an account? <a href="/auth/sign-up">Sign Up Here</a></label>
</main>
@endsection