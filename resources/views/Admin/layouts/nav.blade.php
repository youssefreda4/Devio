<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.home') }}">Devio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item @if (request()->is('admin/home')) active @endif">
                    <a class="nav-link " aria-current="page" href="{{ route('admin.home') }}">Home</a>
                </li>
                @auth

                    <li class="nav-item @if (request()->is('admin/posts*')) active @endif">
                        <a class="nav-link" href="{{ route('post.view') }}">Posts</a>
                    </li>
                    {{-- @can('admin-control') --}}
                        <li class="nav-item @if (request()->is('admin/users*')) active @endif">
                            <a class="nav-link" href="{{ route('users.index') }}">Users</a>
                        </li>
                        <li class="nav-item @if (request()->is('admin/tags*')) active @endif">
                            <a class="nav-link" href="{{ route('tags.index') }}">Tags</a>
                        </li>
                        <li class="nav-item @if (request()->is('admin/settings*')) active @endif">
                            <a class="nav-link" href="{{ route('settings.view') }}">Settings</a>
                        </li>
                    {{-- @endcan --}}
                @endauth
            </ul>

            <form action="{{ route('post.search') }}" method="get" class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>
    </div>
</nav>
