<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('front.home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a
                        class="nav-link px-lg-3 py-3 py-lg-4 @if (request()->is('/')) text-info @endif"
                        href="{{ route('front.home') }}">Home</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link px-lg-3 py-3 py-lg-4 @if (request()->is('posts*')) text-info @endif"
                        href="{{ route('front.posts') }}">Posts</a></li>
                <li class="nav-item"><a
                        class="nav-link px-lg-3 py-3 py-lg-4 @if (request()->is('about')) text-info @endif"
                        href="{{ route('front.about') }}">About</a></li>
                <li class="nav-item"><a
                        class="nav-link px-lg-3 py-3 py-lg-4 @if (request()->is('contact')) text-info @endif"
                        href="{{ route('front.contact') }}">Contact</a></li>
                @guest
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4"
                            href="{{ route('register') }}">Register</a></li>
                @else
                    @if (auth()->user()->type == 'admin')
                        <li class="nav-item "><a class="nav-link px-lg-3 py-3 py-lg-4 text-primary"
                                href="{{ route('post.view') }}">Dashboard</a></li>
                    @else
                        <li class="nav-item dropdown mt-3">
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
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
