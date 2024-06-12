<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Cart</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
        }

        nav#header {
        background-color: #333;
        padding-top: 4px;
        padding-bottom: 4px;
    }

    nav {
        display: flex;
        align-items: center;
        height: 50px; /* Set a fixed height for the navbar */
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
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        left: 0;
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

    /* Text colors */
    .text-gray-100 {
        color: #d1d5db;
    }

    .text-white {
        color: #ffffff;
    }

    /* Button hover effects */
    .hover\:text-white:hover {
        color: #ffffff;
    }

    .hover\:underline:hover {
        text-decoration: underline;
    }

    /* Custom outline styles */
    .focus\:outline {
        outline: 2px solid transparent;
        outline-offset: 2px;
    }

    .focus\:rounded-sm:focus {
        border-radius: 0.125rem;
    }

    .focus\:outline-red-500:focus {
        outline-color: #ef4444;
    }

    /* Custom spacing */
    .py-2 {
        padding-top: 0.1rem;
        padding-bottom: 0.1rem;
    }

    .pt-1\/32 {
        padding-top: 0.03125rem;
    }

    .pb-1\/32 {
        padding-bottom: 0.03125rem;
    }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }
        .cart-section, .summary-section {
            background: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .cart-section {
            width: 60%;
            margin-right: 5%;
        }
        .summary-section {
            width: 30%;
        }
        h2, h3 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .notification {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .success {
            background-color: #4caf50;
            color: #fff;
        }
        .error {
            background-color: #f44336;
            color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #f9f9f9;
        }
        .actions button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .actions button:hover {
            background-color: #333;
            color: #fff;
        }
        .proceed-btn {
            display: inline-block;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .proceed-btn:hover {
            background-color: #45a049;
        }
        .product-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        input[type="number"] {
            width: 50px;
            height: 30px;
            text-align: center;
        }
        .summary-section form {
            margin-bottom: 20px;
        }
        .summary-section form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
    </style>

    

</head>
<body>

<header>
    <nav id="header" class="w-full z-30 top-0 bg-gray-800 shadow-sm">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-3 py-2">
            <label for="menu-toggle" class="cursor-pointer md:hidden block">
                <svg class="fill-current text-white stroke-2 stroke-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <title>menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                </svg>
            </label>
            <input class="hidden" type="checkbox" id="menu-toggle" />
            <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
                <nav>
                    <ul class="md:flex items-center justify-between text-xs text-gray-100 pt-1 md:pt-0">
                        <li><a href="{{ route('home') }}" class="inline-block no-underline hover:text-white hover:underline py-1 px-1 md:px-2 text-base">Shop</a></li>
                        <li><a href="#" class="inline-block no-underline hover:text-white hover:underline py-1 px-1 md:px-2 text-base">About</a></li>
                    </ul>
                </nav>
            </div>
            <div class="order-1 md:order-2">
                <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-white text-lg" href="#">
                    UDesign
                </a>
            </div>
            <div class="order-2 md:order-3 flex items-center" id="nav-content">
                @auth
                <div class="sm:top-0 sm:right-0 p-1 md:p-2 text-right z-10">
                    <span class="font-semibold text-gray-100 mr-2">Hello, {{ Auth::user()->name }}</span>
                    <div class="dropdown bg-gray-800 inline-block">
                        <button class="dropbtn font-semibold text-gray-100 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
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
                <a href="{{ route('login') }}" class="font-semibold text-gray-100 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-1 md:ml-2 font-semibold text-gray-100 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
                @endauth
                <a class="pl-1 md:pl-2 inline-block no-underline hover:text-white" href="#">
                    <svg class="fill-current hover:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.924-0.606L22.616,9H21V7z M16,21c-1.104,0-2-0.896-2-2s0.896-2,2-2s2,0.896,2,2S17.104,21,16,21z M10,21 c-1.104,0-2-0.896-2-2s0.896-2,2-2s2,0.896,2,2S11.104,21,10,21z" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>
</header>




    <div class="container">
        <div class="cart-section">
            <h2>Your Cart</h2>
            @if(session('success'))
                <div class="notification success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="notification error">{{ session('error') }}</div>
            @endif
            @if($carts->isEmpty())
                <p>Your cart is empty.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $cart)
                            <tr>
                                <td>{{ $cart->product->name }}</td>
                                <td><img src="{{ 'storage/' .$cart->product->image }}" alt="{{ $cart->product->name }}" class="product-img"></td>
                                <td>
                                    <form action="{{ route('cart.update', $cart->id) }}" method="POST" onchange="updateTotal('{{ $cart->id }}')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" onclick="changeQuantity('{{ $cart->id }}', -1)">-</button>
                                        <input type="number" name="quantity" id="quantity-{{ $cart->id }}" value="{{ $cart->quantity }}" min="1" readonly>
                                        <button type="button" onclick="changeQuantity('{{ $cart->id }}', 1)">+</button>
                                    </form>
                                </td>
                                <td id="price-{{ $cart->id }}">${{ number_format($cart->product->price, 2) }}</td>
                                <td id="total-{{ $cart->id }}">${{ number_format($cart->product->price * $cart->quantity, 2) }}</td>
                                <td class="actions">
                                    <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="summary-section">
            <div class="summary">
                <h3>Order Summary</h3>
                <p>Number of Items: <span id="num-items">{{ $carts->count() }}</span></p>
                <p>Subtotal: <span id="subtotal">$0.00</span></p>
                <p>Shipping Fee: $5.00</p>
                <p>Total: <span id="total">$0.00</span></p>
            </div>
            <form action="{{ route('cart.updateAddress') }}" method="POST">
                @csrf
                @method('PATCH')
                <h3>Billing Address</h3>
                <p>Current Address: <span id="current-address">{{ $customer->address }}</span></p>
                <label for="new-address">Change Address:</label>
                <input type="text" name="new_address" id="new-address" placeholder="Enter new address">
                <button type="submit" class="proceed-btn">Update Address</button>
            </form>
            <div class="mt-8">
                <a href="{{ route('checkout.index') }}" class="proceed-btn">Proceed to Checkout</a>
            </div>
        </div>
    </div>

    <script>
        function changeQuantity(cartId, amount) {
            let quantityInput = document.getElementById('quantity-' + cartId);
            let quantity = parseInt(quantityInput.value);
            quantity += amount;
            if (quantity < 1) {
                quantity = 1;
            }
            quantityInput.value = quantity;
            updateTotal(cartId);
        }

        function updateTotal(cartId) {
            let quantityInput = document.getElementById('quantity-' + cartId);
            let quantity = parseInt(quantityInput.value);
            let price = parseFloat(document.getElementById('price-' + cartId).textContent.replace('$', ''));
            let totalElement = document.getElementById('total-' + cartId);
            let total = quantity * price;
            totalElement.textContent = '$' + total.toFixed(2);
            updateSummary();
        }

        function updateSummary() {
            let numItems = 0;
            let subtotal = 0;
            document.querySelectorAll('[id^="total-"]').forEach(function(element) {
                let price = parseFloat(element.textContent.replace('$', ''));
                subtotal += price;
                numItems++;
            });
            let shippingFee = 5.00;
            let total = subtotal + shippingFee;
            document.getElementById('num-items').textContent = numItems;
            document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
            document.getElementById('total').textContent = '$' + total.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateSummary();
        });
    </script>
</body>
</html>
