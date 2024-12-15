<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('front.home') }}">{{ $setting->site_name }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse " id="navbarResponsive">
            <ul class="navbar-nav ms-auto  py-4 py-lg-0">
                <li class="nav-item"><a
                        class="nav-link px-lg-3 py-3 py-lg-4 @if (request()->is('/')) text-info @endif"
                        href="{{ route('front.home') }}">Home</a>
                </li>
                <li class="nav-item"><a
                        class="nav-link px-lg-3 py-3 py-lg-4 @if (request()->is('posts*')) text-info @endif"
                        href="{{ route('front.posts') }}">Posts</a></li>


                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link px-lg-3 py-3 py-lg-4 dropdown-toggle" href="#" id="notificationDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>

                            @if (auth()->user()->unreadNotifications->count() != 0)
                                <span
                                    class="badge bg-danger rounded">{{ count(auth()->user()->unreadNotifications) }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end rounded" aria-labelledby="notificationDropdown">
                            @forelse (auth()->user()->unreadNotifications as $notification)
                                <li>
                                    @if (isset($notification->data['comment_content']))
                                        <a class="dropdown-item"
                                            href="{{ route('front.posts.markAsRead', $notification->id) }}">
                                            <i class="fas fa-comment-dots me-2"></i> {{ $notification->data['user_name'] }}
                                            : {{ $notification->data['comment_content'] }}
                                            <span class="float-right text-muted text-sm">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </span>
                                        </a>
                                    @elseif (isset($notification->data['status']))
                                        <a class="dropdown-item"
                                            href="{{ route('front.posts.markAsRead', $notification->id) }}">
                                            <i class="fas fa-thumbs-up me-2"></i>
                                            {{ $notification->data['user_name'] }}
                                            Liked
                                            <span class="float-right text-muted text-sm">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </span>
                                        </a>
                                    @endif
                                </li>

                            @empty
                                <div class="m-3">
                                    <div class="text-center alert alert-info">
                                        There is no Notifications !
                                    </div>
                                </div>
                            @endforelse

                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item"><a
                            class="nav-link px-lg-3 py-3 py-lg-4 @if (request()->is('about')) text-info @endif"
                            href="{{ route('front.about') }}">About</a></li>
                    <li class="nav-item"><a
                            class="nav-link px-lg-3 py-3 py-lg-4 @if (request()->is('contact')) text-info @endif"
                            href="{{ route('front.contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    @if (auth()->user()->type == 'admin')
                        <li class="nav-item "><a class="nav-link px-lg-3 py-3 py-lg-4 text-primary"
                                href="{{ route('admin.home') }}">Dashboard</a></li>
                    @else
                        <li class="nav-item dropdown mt-3">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end rounded" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('front.profile') }}">
                                    Profile                                    
                                </a>

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
