<header>
    <div class="header-dashboard">
        <nav class="navbar navbar-dark">
            <div class="container-fluid px-4">
                <a href="{{route('home')}}" target="_blank" class="navbar-brand btn"><i class="fa-solid fa-sitemap"></i> Vai al sito</a>
                <div class="d-flex align-items-center">
                    <a href="{{ route('profile.edit') }}" class="text-white text-decoration-none me-3">{{ Auth::user()->name }}</a>
                    <form class="d-flex" role="search" action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</header>
