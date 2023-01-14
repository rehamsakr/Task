<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('dashboard.home') }}">[Task Logo]</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ active_menu('dashboard.home') }}">
                    <a class="nav-link" href="{{ route('dashboard.home') }}">@lang('translation.dashboard') <span class="sr-only"></span></a>
                </li>

                <li class="nav-item {{ active_menu('dashboard.posts.*') }}">
                    <a class="nav-link" href="{{ route('dashboard.posts.index') }}">@lang('translation.posts') <span class="sr-only"></span></a>
                </li>

                <li class="nav-item {{ active_menu('dashboard.comments.*') }}">
                    <a class="nav-link" href="{{ route('dashboard.comments.index') }}">@lang('translation.comments') <span class="sr-only"></span></a>
                </li>
            </ul>

            <li class="nav-item dropdown list-unstyled">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Welcome, {{ auth()->user()->username }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    >Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </div>
    </nav>
</header>
