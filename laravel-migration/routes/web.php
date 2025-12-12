<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ContactController;

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

/**
 * Landing Page Routes
 */
Route::get('/', [LandingPageController::class, 'index'])->name('home');

/**
 * Contact Routes
 */
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/**
 * Course Routes
 */
Route::get('/courses', function () {
    return view('courses.index');
})->name('courses.all');

Route::get('/courses/{slug}', function ($slug) {
    return view('courses.show');
})->name('courses.show');

/**
 * Scholarship Routes
 */
Route::get('/scholarships', function () {
    return view('pages.scholarships');
})->name('scholarships');

/**
 * Authentication Routes (if using Laravel Auth)
 */
// Route::middleware('guest')->group(function () {
//     Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
//     Route::post('/register', [RegisteredUserController::class, 'store']);
// });
