@props(['href' => route('pages.home')])

<li class="nav-item">
    <a class="nav-link" href="{{ $href }}">
        {{ $slot }}
    </a>
</li>
