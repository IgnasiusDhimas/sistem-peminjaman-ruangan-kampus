<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    {{-- ===========================
          PRIMARY NAVIGATION BAR
         =========================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT SIDE: Logo + Navigation Links --}}
            <div class="flex">

                {{-- Logo aplikasi --}}
                <div class="shrink-0 flex items-center">
                    @if(Route::has('dashboard'))
                        <a href="{{ route('dashboard') }}">
                    @endif
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                {{-- Menu utama (desktop) --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if(Route::has('dashboard'))
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif
                </div>

            </div>

            {{-- RIGHT SIDE: User Settings --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                {{-- Dropdown user --}}
                <x-dropdown align="right" width="48">

                    {{-- Tombol pemicu dropdown --}}
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 
                            bg-white hover:text-gray-700 transition">

                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    {{-- Isi dropdown --}}
                    <x-slot name="content">

                        {{-- Edit Profil --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- Hamburger menu (mobile) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': !open}" 
                            class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{'hidden': !open, 'inline-flex': open}"
                            class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- ===========================
          RESPONSIVE NAVIGATION
         =========================== --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">

        {{-- Link dashboard (mobile) --}}
        <div class="pt-2 pb-3 space-y-1">
            @if(Route::has('dashboard'))
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif
        </div>

        {{-- User settings (mobile) --}}
        <div class="pt-4 pb-1 border-t border-gray-200">

            {{-- Nama & email user --}}
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            {{-- Menu (profile + logout) --}}
            <div class="mt-3 space-y-1">

                {{-- Edit profil --}}
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>

        </div>
    </div>

</nav>
