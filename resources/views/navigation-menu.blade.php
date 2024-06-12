<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Layout</title>
    <style>
        .ml {
            margin-left: 20%;
        }
        .main-content {
    padding: 20px; /* Adjust as needed */
    max-width: 700px; /* Or your desired width */
  }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <div class="flex h-screen" style="height: 10vh;">
        <!-- Sidebar -->
        <aside class="w-1/5 bg-gray-800 text-white fixed h-full">
            <div class="py-4 px-3">
                <h2 class="text-lg font-semibold">
                    @if (Auth::user()->role === \App\Enums\Role::SuperAdministrator)
                        Admin Panel
                    @elseif (Auth::user()->role === \App\Enums\Role::salesManager)
                        Manager Panel
                    @endif
                </h2>
                <nav class="mt-5">
                    <ul>
                        <li>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-900 rounded hover:bg-gray-700">
                                Dashboard
                            </a>
                        </li>
                        @if (Auth::user()->role === \App\Enums\Role::SuperAdministrator)
                        <li>
                            <a href="{{ route('user.index') }}" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-900 rounded hover:bg-gray-700">
                                User List
                            </a>
                        </li>
                        @endif
                        
                        <li>
                            <a href="{{ route('customer.index') }}" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-900 rounded hover:bg-gray-700">
                                Customer Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('category.index') }}" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-900 rounded hover:bg-gray-700">
                                Category
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('product.index') }}" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-900 rounded hover:bg-gray-700">
                                Product
                            </a>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-900 rounded hover:bg-gray-700">
                                Order
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" class="block px-4 py-2 mt-2 text-sm font-semibold bg-gray-900 rounded hover:bg-gray-700">
                                Home
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main content area -->
        <div class="ml w-4/5" style="height: 50px;">


            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}">
                                    <x-application-mark class="block h-9 w-auto" />
                                </a>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->name }}
                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Account') }}
                                        </div>
                                        <x-dropdown-link href="{{ route('profile.show') }}">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                                {{ __('API Tokens') }}
                                            </x-dropdown-link>
                                        @endif
                                        <div class="border-t border-gray-200"></div>
                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
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
                        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    </div>
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="shrink-0 mr-3">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                    {{ __('API Tokens') }}
                                </x-responsive-nav-link>
                            @endif
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            <div id="dynamic-content">
                <!-- Content will be dynamically loaded here -->
            </div>
        </div>
    </div>

    <script>
    // Fetch content dynamically based on the clicked link
    $(document).ready(function () {
  $('a[data-url]').on('click', function (e) {
    e.preventDefault();
    var url = $(this).attr('href'); // Get the href attribute of the clicked link
    $('#dynamic-content').empty(); // Clear existing content before loading new content
    $('#dynamic-content').load(url); // Load content from the specified URL into the dynamic-content div
  });
});
</script>



    
</body>
</html>
