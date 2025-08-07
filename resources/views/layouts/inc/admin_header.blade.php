<header class="bg-white shadow px-6 py-4">
    <div class="flex justify-between items-center">
        <h1 class="text-lg font-semibold">Admin Panel</h1>
        <div>
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm focus:outline-none">
                        {{ Auth::user()->name }}
                        <svg class="ml-2 w-4 h-4" viewBox="0 0 20 20"><path d="..." /></svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
