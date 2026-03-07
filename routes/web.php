<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;  
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
 
Route::get('/', [HomeController::class, 'index'])->name('landing');  
Route::get('/shop', [ShopController::class, 'index'])->name('home');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('products.show');
 
Route::get('/email/verify/{id}/{hash}', function (Illuminate\Http\Request $request, $id, $hash) {
    $user = App\Models\User::findOrFail($id);
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403);
    }
    if (! $request->hasValidSignature()) {
        abort(403);
    }
    if (! $user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
        event(new Illuminate\Auth\Events\Verified($user));
    }
    return redirect()->route('login')->with('success', 'Email verified successfully! You may now sign in.');
})->name('verification.verify');
 
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
 
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::get('/my-orders', [CustomerController::class, 'orderHistory'])->name('orders.history');
    Route::get('/my-profile', [CustomerController::class, 'editProfile'])->name('profile.edit');
    Route::put('/my-profile', [CustomerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});
 
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::delete('products/gallery/{id}', [ProductController::class, 'deleteImage'])->name('products.gallery.destroy');
});