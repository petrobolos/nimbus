<ul class="navbar-nav ml-auto">
    @guest
        <x-nav-link :href="route('login')">
            {{ __('Login') }}
        </x-nav-link>

        <x-nav-link :href="route('register')">
            {{ __('Register') }}
        </x-nav-link>
    @else
        <li class="nav-item dropdown">
            <a
                id="navbarDropdown"
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="">
                    {{ __('Profile') }}
                </a>
                <a
                    class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                >
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
