@extends('auth.layouts.main')
@section('content')
<main class="form-signin">
    <form action="/auth/sign-up" method="POST">
        @csrf
        <h1 class="fw-bold text-white bg-danger rounded py-2">BlogQu</h1>
        <div class="form-floating mb-2">
            <input type="text" class="form-control @error('name')
            is-invalid @enderror" placeholder="Input Name" autofocus name="name" value="{{ old('name') }}">
            <label for="name">Name</label>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-2">
            <input type="text" class="form-control @error('username')
            is-invalid @enderror" placeholder="Input Username" name="username" value="{{ old('username') }}">
            <label for=" username">Username</label>
            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-2">
            <input type="email" class="form-control @error('email')
            is-invalid @enderror" placeholder="name@example.com" name="email" value="{{ old('email') }}">
            <label for=" email">Email address</label>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control @error('password')
            is-invalid @enderror" placeholder="Password" name="password">
            <label for="password">Password</label>
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-floating">
            <input type="password" class="form-control @error('confirmPassword')
            is-invalid @enderror" placeholder="Password" name="confirmPassword">
            <label for="confirmPassword">Confirm Password</label>
            @error('confirmPassword')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button class="w-100 btn btn-lg btn-outline-success" type="submit">Sign Up</button>
    </form>
    <label class="mt-3">Already have an account? <a href="/auth/sign-in">Sign In Here</a></label>
</main>
@endsection