<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StrawberryProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AdminTestimonialController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\Admin\AdminFAQController;
use App\Http\Controllers\OrderController;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('strawberry-products', StrawberryProductController::class);
    Route::patch('strawberry-products/{strawberryProduct}/status', [StrawberryProductController::class, 'updateStatus'])->name('strawberry-products.update-status');
    
    // User product routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product}', [UserProductController::class, 'show'])->name('products.show');
    });
    
    // Testimonial routes
    Route::resource('testimonials', TestimonialController::class)->only(['index', 'create', 'store', 'show']);
    
    // FAQ routes
    Route::get('/faq', [FAQController::class, 'index'])->name('faqs.index');
});

// Contact routes
Route::get('/kontak', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

// Education pages
Route::get('/edukasi/perawatan-strawberry', function () {
    return view('education.strawberry-care');
})->name('education.strawberry-care');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.update-role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/summary', [AdminReportController::class, 'downloadSummary'])->name('reports.summary');
    
    // Admin testimonial routes
    Route::get('/testimonials', [AdminTestimonialController::class, 'index'])->name('testimonials.index');
    Route::delete('/testimonials/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('testimonials.destroy');
    
    // Admin contact routes
    Route::get('/contact', [App\Http\Controllers\AdminContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/create', [App\Http\Controllers\AdminContactController::class, 'create'])->name('contact.create');
    Route::post('/contact', [App\Http\Controllers\AdminContactController::class, 'store'])->name('contact.store');
    Route::get('/contact/{contactInfo}/edit', [App\Http\Controllers\AdminContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/{contactInfo}', [App\Http\Controllers\AdminContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact/{contactInfo}', [App\Http\Controllers\AdminContactController::class, 'destroy'])->name('contact.destroy');
    Route::patch('/contact/{contactInfo}/set-active', [App\Http\Controllers\AdminContactController::class, 'setActive'])->name('contact.set-active');
    
    // Admin product introduction routes
    Route::get('/product-introduction', [App\Http\Controllers\AdminProductIntroductionController::class, 'index'])->name('product-introduction.index');
    Route::get('/product-introduction/create', [App\Http\Controllers\AdminProductIntroductionController::class, 'create'])->name('product-introduction.create');
    Route::post('/product-introduction', [App\Http\Controllers\AdminProductIntroductionController::class, 'store'])->name('product-introduction.store');
    Route::get('/product-introduction/{id}/edit', [App\Http\Controllers\AdminProductIntroductionController::class, 'edit'])->name('product-introduction.edit');
    Route::put('/product-introduction/{id}', [App\Http\Controllers\AdminProductIntroductionController::class, 'update'])->name('product-introduction.update');
    Route::delete('/product-introduction/{id}', [App\Http\Controllers\AdminProductIntroductionController::class, 'destroy'])->name('product-introduction.destroy');
    Route::post('/product-introduction/{id}/set-active', [App\Http\Controllers\AdminProductIntroductionController::class, 'setActive'])->name('product-introduction.set-active');
    
    // Admin FAQ routes
    Route::resource('faqs', AdminFAQController::class);
    
    // Admin Order routes (Pemesanan hanya untuk admin)
    Route::get('/orders', [App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [App\Http\Controllers\AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/{order}/upload-payment-proof', [App\Http\Controllers\AdminOrderController::class, 'uploadPaymentProof'])->name('orders.upload-payment-proof');
    Route::delete('/orders/{order}/delete-payment-proof', [App\Http\Controllers\AdminOrderController::class, 'deletePaymentProof'])->name('orders.delete-payment-proof');
    Route::patch('/orders/{order}/update-notes', [App\Http\Controllers\AdminOrderController::class, 'updateNotes'])->name('orders.update-notes');
    Route::delete('/orders/{order}', [App\Http\Controllers\AdminOrderController::class, 'destroy'])->name('orders.destroy');
});
