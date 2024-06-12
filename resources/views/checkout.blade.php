<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="font-sans antialiased">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-4xl font-bold mb-8">Checkout</h2>
        <!-- Checkout form goes here -->
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <!-- Add your checkout form fields here -->
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">Place Order</button>
        </form>
    </div>
</body>
</html>
