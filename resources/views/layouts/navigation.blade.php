@php
    $roleType = Auth::user()->role;
    $redirectUrl = 'dashboard';

    switch ($roleType) {
        //Admin
        case 1:
            $redirectUrl = 'admin.dashboard';
            break;
        
        default:
            $redirectUrl = 'dashboard';
            break;
    }
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center space-x-4 p-2 bg-transparent">
                    <a href="{{ route($redirectUrl) }}">
                        <x-application-logo-home/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route($redirectUrl)" :active="request()->routeIs($redirectUrl)">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Admin Links --}}
                    @if (Auth::user()->role == 1)
                    <x-nav-link href="/admin/brands" :active="request()->routeIs('admin.brands')">
                        {{ __('Brands') }}
                    </x-nav-link>
                    <x-nav-link href="/admin/unitmodels" :active="request()->routeIs('admin.model')">
                        {{ __('Model') }}
                    </x-nav-link>
                    <x-nav-link href="/admin/units" :active="request()->routeIs('admin.unit')">
                        {{ __('Unit') }}
                    </x-nav-link>
                    <x-nav-link href="/admin/locations" :active="request()->routeIs('admin.location')">
                        {{ __('Location') }}
                    </x-nav-link>
                    <x-nav-link href="/admin/statusunits" :active="request()->routeIs('admin.statusunit')">
                        {{ __('Status Unit') }}
                    </x-nav-link>
                    <x-nav-link href="/admin/manpowers" :active="request()->routeIs('admin.manpower')">
                        {{ __('Manpower') }}
                    </x-nav-link>
                    <x-nav-link href="/admin/groupcomponent" :active="request()->routeIs('admin.groupcomponent')">
                        {{ __('Group Component') }}
                    </x-nav-link>
                    <x-nav-link href="/admin/componentdetail" :active="request()->routeIs('admin.componentdetail')">
                        {{ __('Component Detail') }}
                    </x-nav-link>
                    @endif
                    
                    {{-- User Links --}}
                    @if (Auth::user()->role == 2)
                    <x-nav-link href="/user/reports" :active="request()->routeIs('user.report')">
                        {{ __('Reports') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route($redirectUrl)" :active="request()->routeIs($redirectUrl)">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            {{-- Admin Links --}}
            @if (Auth::user()->role == 1)
            <x-responsive-nav-link href="/admin/brands" :active="request()->routeIs('admin.brands')">
                {{ __('Brands') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/admin/unitmodels" :active="request()->routeIs('admin.model')">
                {{ __('Model') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/admin/units" :active="request()->routeIs('admin.unit')">
                {{ __('Unit') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/admin/locations" :active="request()->routeIs('admin.location')">
                {{ __('Location') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/admin/statusunits" :active="request()->routeIs('admin.statusunit')">
                {{ __('Status Unit') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/admin/manpowers" :active="request()->routeIs('admin.manpower')">
                {{ __('Manpower') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/admin/groupcomponent" :active="request()->routeIs('admin.groupcomponent')">
                {{ __('Group Component') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/admin/componentdetail" :active="request()->routeIs('admin.componentdetail')">
                {{ __('Component Detail') }}
            </x-responsive-nav-link>
            @endif
            
            {{-- User Links --}}
            @if (Auth::user()->role == 2)
            <x-responsive-nav-link href="/user/reports" :active="request()->routeIs('user.report')">
                {{ __('Reports') }}
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
