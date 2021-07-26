<ul class="navbar-nav mr-auto">
    @guest
        <x-nav-link :href="'#'">
            <strong>{{ __('Play Demo!') }}</strong>
        </x-nav-link>
        <x-nav-link :href="'#'">
            {{ __('About') }}
        </x-nav-link>
        <x-nav-link :href="'#'">
            {{ __('FAQs') }}
        </x-nav-link>
    @else
        <x-nav-link :href="'#'">
            {{ __('Feed') }}
        </x-nav-link>
        <x-nav-link :href="'#'">
            {{ __('Single Player') }}
        </x-nav-link>
        <x-nav-link :href="'#'">
            {{ __('Casual Multiplayer') }}
        </x-nav-link>
        <x-nav-link :href="'#'">
            {{ __('Ranked Multiplayer') }}
        </x-nav-link>
        <x-nav-link :href="'#'">
            {{ __('Custom Game') }}
        </x-nav-link>
    @endguest
</ul>
