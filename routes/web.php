
<?php
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesManagerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CuserController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\CheckoutController;

// Home page
Route::get('/', function () {
    $products = Product::all(); // Fetch all products from the database
    return view('home', compact('products'));
})->name('home');




Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route to home page
    Route::get('/home', function () {
        $products = Product::all(); // Fetch all products from the database
        return view('home', compact('products')); // Pass products to the view
    })->name('home');

    // Dashboard route accessible to Super Administrators and Sales Managers
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('role:SuperAdministrator,salesManager');

    //Cart 
    Route::post('/cart/add/{id}', [cartController::class, 'add'])->name('cart.add')->middleware('auth');
    Route::get('/cart', [cartController::class, 'index'])->name('cart.index')->middleware('auth');
    Route::patch('/cart/update/{id}', [cartController::class, 'update'])->name('cart.update')->middleware('auth');
    Route::delete('/cart/remove/{id}', [cartController::class, 'destroy'])->name('cart.remove')->middleware('auth');

    Route::patch('/cart/update-address', [App\Http\Controllers\cartController::class, 'updateAddress'])->name('cart.updateAddress');



    //Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Product CRUD routes
    Route::resource('product', ProductController::class);
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
  

    // Customer routes accessible only to customers
    Route::middleware(['role:Customer'])->group(function () {
        Route::get('/customer/dashboard', [CustomerController::class, 'dashboard']);
        // Other customer routes
    });

    // Sales Manager routes
    Route::middleware(['role:salesManager'])->group(function () {
        Route::resource('products', ProductController::class);

        // Corrected Route for creating a category
        Route::post('/admin/category/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/admin/category', [CategoryController::class, 'store'])->name('admin.categories.store');

        Route::resource('/admin/category', CategoryController::class)->except(['create', 'store']);
        Route::get('/sales_manager/orders', [SalesManagerController::class, 'orders']);
        // Other sales manager routes
    });

    // Admin routes accessible only to Super Administrators
    Route::middleware(['role:SuperAdministrator'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
        Route::resource('categories', CategoryController::class)->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy'
        ]);

        Route::resource('products', ProductController::class)->names([
            'index' => 'product.index',
            'create' => 'product.create',
            'store' => 'product.store',
            'show' => 'product.show',
            'edit' => 'product.edit',
            'update' => 'product.update',
            'destroy' => 'product.destroy'
        ]);
        
        Route::resource('/admin/product', ProductController::class);
        Route::resource('/admin/order', OrderController::class);
        Route::get('/admin/customer', [CustomerController::class, 'index'])->name('customer.index');
        Route::resource('/admin/user', CuserController::class);
        // Other admin routes
    });
});
