<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: gainsboro;
        }

        header {
            background-color: #333;
            padding: 0px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        section {
            text-align: center;
            padding: 30px 150px;
        }

        .product-card {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .product-card img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }

        /* Dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            left: 20; /* Align dropdown to the left */
            right: 0;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
    @vite('resources/css/app.css')
</head>

<body>
    <header>
    <nav id="header" class="w-full z-30 top-0 py-1/16 pt-1/32 pb-1/32 bg-gray-10 shadow-sm">  <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-3 py-0">
    <label for="menu-toggle" class="cursor-pointer md:hidden block">
      <svg class="fill-current text-white stroke-2 stroke-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">  <title>menu</title>
        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
      </svg>
    </label>
    <input class="hidden" type="checkbox" id="menu-toggle" />

    <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
      <nav>
        <ul class="md:flex items-center justify-between text-xs text-gray-700 pt-1 md:pt-0">
          <li><a href="#" class="inline-block no-underline hover:text-black hover:underline py-1 px-1 md:px-2 text-base">Shop</a></li>
          <li><a href="#" class="inline-block no-underline hover:text-black hover:underline py-1 px-1 md:px-2 text-base">About</a></li>
        </ul>
      </nav>
    </div>

    <div class="order-1 md:order-2">
      <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-white-800 text-sm" href="#">
        UDesign
      </a>
    </div>

    <div class="order-2 md:order-3 flex items-center" id="nav-content">
      @auth
        <div class="sm:top-0 sm:right-0 p-1 md:p-3 text-right z-10">
          <span class="font-semibold text-white-600 mr-2">Hello, {{ Auth::user()->name }}</span>
          
          <div class="dropdown bg-gray-10" >
            <button class="dropbtn font-semibold text-white-600 hover:text-gray- focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
              Account
            </button>
            <div class="dropdown-content">
              @if (Auth::user()->role === \App\Enums\Role::SuperAdministrator || Auth::user()->role === \App\Enums\Role::salesManager)
                <a href="{{ route('dashboard') }}">Dashboard</a>
              @endif
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
              </form>
            </div>
          </div>
        </div>
      @else
        <a href="{{ route('login') }}" class="font-semibold text-white-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
        @if (Route::has('register'))
          <a href="{{ route('register') }}" class="ml-1 md:ml-2 font-semibold text-white-600 hover:text-gray-900 focus:outline focus
:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                    @endauth

                    <a class="pl-1 md:pl-2 inline-block no-underline hover:text-black" href="#">
                        <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.924-0.606L22.616,9H21V7z M16,21c-1.104,0-2-0.896-2-2s0.896-2,2-2s2,0.896,2,2S17.104,21,16,21z M10,21 c-1.104,0-2-0.896-2-2s0.896-2,2-2s2,0.896,2,2S11.104,21,10,21z" />
                        </svg>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <section style="position: relative; padding: 0px; height: 550px;">
        <img src="{{ asset('images/home.jpg') }}" alt="Description Image"
            style="width: 100%; height: 100%; filter: blur(0px);">
        <p
            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 50%; padding: 10px; box-sizing: border-box; margin: 0; font-size: 40px; font-family: 'Your Chosen Font', sans-serif; font-style: italic; color: #fff;">
            Elevate Your Wardrobe,<br> One Design at a Time</p>
    </section>

    <section>
        <h2 class="text-4xl font-bold text-black text-left ml-0">Store</h2><br>

        <!-- Container for the Product Grid -->
        <div class="container mx-auto mt-8">
    <!-- Responsive Grid Layout for Products -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
        <!-- Individual Product Card -->
        <div class="max-w-sm rounded-lg overflow-hidden shadow-lg bg-white border-2 border-gray-200">
            @if ($product->image)
            <!-- Product Image with Hover Effect -->
            <div class="h-64 overflow-hidden">
                <img class="w-full h-full object-cover object-center hover:scale-110 transition-transform duration-300"
                    src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
            @endif
            <!-- Product Details -->
            <div class="px-1 py-4">
                <!-- Product Name -->
                <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                <!-- Product Description -->
                <p class="text-gray-700 text-base truncate-3-lines">{{ $product->description }}</p>
                <!-- Product Price -->
                <p class="text-gray-900 font-bold mt-2">${{ number_format($product->price, 2) }}</p>
            </div>
            <!-- View Details Button -->
            <div class="px-6 pt-4 pb-2">
                <a href="{{ route('product.show', $product->id) }}"
                    class="bg-gray-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    View Details
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Custom class to truncate text after 3 lines */
    .truncate-3-lines {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

    </section>

    <footer>
        <p>&copy; 2024 Your Website. All Rights Reserved.</p>
    </footer>
</body>

</html>
