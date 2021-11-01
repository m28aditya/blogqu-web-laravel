<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="/">BlogQu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link mx-md-2  {{ (Request::is('/'))? 'active' : '' }}" href="/">Home</a>
                    @auth
                    <a class="nav-link  {{ (Request::is('dashboard*'))? 'active' : '' }}" href="/dashboard">My
                        Dashboard</a>
                    @endauth
                </div>
                @guest
                <div class="navbar-nav ms-auto">
                    <a class="nav-link btn btn-success text-white fw-bold px-3" href="{{ route('login') }}">Sign-in</a>
                </div>
                @endguest
                @auth
                <form action="/auth/sign-out" method="post" class="navbar-nav ms-auto">
                    @csrf
                    <button type="submit" class="nav-link btn btn-success text-white fw-bold px-3">Sign-out</button>
                </form>
                @endauth
            </div>
        </div>
    </nav>
</header>