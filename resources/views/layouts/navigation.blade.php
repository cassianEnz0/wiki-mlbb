<nav x-data="{ open: false }" class="bg-white dark:bg-[#0f172a] border-b border-gray-100 dark:border-yellow-600/30 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-yellow-400" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') && !request('role') && !request('lane')" 
                        class="dark:text-gray-300 dark:hover:text-yellow-400 dark:active:text-yellow-400 transition-colors">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-300 bg-white dark:bg-[#0f172a] hover:text-gray-700 dark:hover:text-yellow-400 focus:outline-none transition ease-in-out duration-150">
                                    <div>Heroes</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('dashboard')">All Heroes</x-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                <div class="px-4 py-2 text-xs text-gray-400 font-bold uppercase tracking-wider">By Role</div>
                                <x-dropdown-link :href="route('dashboard', ['role' => 'Tank'])">Tank</x-dropdown-link>
                                <x-dropdown-link :href="route('dashboard', ['role' => 'Fighter'])">Fighter</x-dropdown-link>
                                <x-dropdown-link :href="route('dashboard', ['role' => 'Assassin'])">Assassin</x-dropdown-link>
                                <x-dropdown-link :href="route('dashboard', ['role' => 'Mage'])">Mage</x-dropdown-link>
                                <x-dropdown-link :href="route('dashboard', ['role' => 'Marksman'])">Marksman</x-dropdown-link>
                                <x-dropdown-link :href="route('dashboard', ['role' => 'Support'])">Support</x-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                                <div class="px-4 py-2 text-xs text-gray-400 font-bold uppercase tracking-wider">By Lane</div>
                                <x-dropdown-link :href="route('dashboard', ['lane' => 'Gold Lane'])">Gold Lane</x-dropdown-link>
                                <x-dropdown-link :href="route('dashboard', ['lane' => 'Exp Lane'])">Exp Lane</x-dropdown-link>
                                <x-dropdown-link :href="route('dashboard', ['lane' => 'Mid Lane'])">Mid Lane</x-dropdown-link>
                                <x-dropdown-link :href="route('dashboard', ['lane' => 'Roamer'])">Roam</x-dropdown-link>
                                <x-dropdown-link :href="route('dashboard', ['lane' => 'Jungler'])">Jungler</x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    {{-- LINK BARU: VIEW (EXPORT EXCEL) --}}
                    <x-nav-link :href="route('heroes.export.excel')" :active="request()->routeIs('heroes.export.excel')">
                        {{ __('View') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-2">
                <button id="theme-toggle" type="button" 
                    class="text-gray-500 dark:text-yellow-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-full text-sm p-2 transition-colors">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-300 bg-white dark:bg-[#0f172a] hover:text-gray-700 dark:hover:text-yellow-400 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-yellow-400 font-semibold transition">Log in</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold transition shadow-sm">Register</a>
                    </div>
                @endauth
            </div>
            <div class="-me-2 flex items-center sm:hidden">
                 <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    </nav>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            {{-- LINK BARU DI MENU MOBILE --}}
            <x-responsive-nav-link :href="route('heroes.export.excel')" :active="request()->routeIs('heroes.export.excel')">
                {{ __('View') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log in') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
