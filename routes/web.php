<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\InvitationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Login ke baad direct short url page
    Route::get('/dashboard', function () {
        return redirect()->route('short-urls.index');
    })->name('dashboard');

    // Short URL listing + create
    Route::resource('short-urls', ShortUrlController::class)->only(['index', 'store']);

    // Resolve route (auth protected -> public nahi)
    Route::get('resolve/{code}', [ShortUrlController::class, 'resolve'])
        ->name('short-urls.resolve');

    // Invitation
    Route::post('invite', [InvitationController::class, 'invite'])
        ->name('invite');
});

require __DIR__.'/auth.php';
