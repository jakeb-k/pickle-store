<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Models\Product; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('product', ProductController::class); 

Route::get('/', [ProductController::class, 'index']); 
Route::get('items/{type}', [ProductController::class, 'type']); 

Route::any('items/{type}/filter', [ProductController::class, 'filter']);

Route::get('/search', [ProductController::class, 'search']);

Route::get('/test',function(){
    return view('products.test'); 
}); 

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [ProductController::class, 'admin']); 
    Route::any('admin/filter',[ProductController::class, 'adminSort']); 

    Route::get('product/{id}/available', [ProductController::class, 'available']);

    Route::post('product/{id}/add-tag', [ProductController::class, 'addTag']);
    Route::get('product/{id}/add-tag/{tag}', [ProductController::class, 'deleteTag']); 

    Route::post('product/{id}/add-option', [ProductController::class, 'addOption']);
    Route::get('product/{id}/add-option/{option}', [ProductController::class, 'deleteOption']); 

    Route::any('add-to-cart/{id}', [ProductController::class, 'addToCart']);
    Route::delete('remove-from-cart', [ProductController::class, 'remove']);
    Route::delete('clear-cart', [ProductController::class, 'clearCart']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('favs/{id}', [ProfileController::class, 'show']);
    Route::any('user/{id}/new-fav', [ProfileController::class, 'newFav']);

    Route::resource('orders', OrderController::class);
    Route::get('user/orders', [ProfileController::class, 'orders']); 

    Route::post('/addReview/{id}', [ReviewController::class, 'addReview']);

    Route::post('user/{id}',[ProfileController::class, 'update']); 

});

Route::post('/checkout', 'App\Http\Controllers\StripeController@checkout')->name('checkout');

Route::post('webhook', 'App\Http\Controllers\StripeController@webhook')->name('webhook');

Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');

Route::get('/checkout', function () {
    return redirect('/')->with('products', Product::paginate(6));
});

require __DIR__.'/auth.php';
