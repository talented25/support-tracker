<!-- Navigation Menu -->
<nav x-data="{ open: false }" class="bg-gray-800 border-b border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        🏠 Dashboard
                    </x-nav-link>
                    <x-nav-link href="{{ route('activities.index') }}" :active="request()->routeIs('activities.*')">
                        📋 Activities
                    </x-nav-link>
                    <x-nav-link href="{{ route('reports.daily') }}" :active="request()->routeIs('reports.daily')">
                        🕓 Daily Report
                    </x-nav-link>
                    <x-nav-link href="{{ route('reports.range.form') }}" :active="request()->routeIs('reports.range.*')">
                        📅 Range Report
                    </x-nav-link>
                    <x-nav-link href="{{ route('reports.export.pdf') }}">
                        📤 Export PDF
                    </x-nav-link>
                    <x-nav-link href="{{ route('reports.export.excel') }}">
                        📥 Export Excel
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white hover:text-gray-300 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 011.414 0L10 11.586l3.293-3.879a1 1 0 111.414 1.414l-4 4.879a1 1 0 01-1.414 0l-4-4.879a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile.edit') }}">
                            ⚙️ Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-gray-900 border-t border-gray-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                🏠 Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('activities.index') }}" :active="request()->routeIs('activities.*')">
                📋 Activities
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('reports.daily') }}" :active="request()->routeIs('reports.daily')">
                🕓 Daily Report
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('reports.range.form') }}" :active="request()->routeIs('reports.range.*')">
                📅 Range Report
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('reports.export.pdf') }}">
                📤 Export PDF
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('reports.export.excel') }}">
                📥 Export Excel
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.edit') }}">
                    ⚙️ Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                        🚪 Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
