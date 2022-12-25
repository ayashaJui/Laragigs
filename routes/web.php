<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Create Listing
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// store Listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Edit Listing
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update Listing
Route::put('/listings/{id}', [ListingController::class, 'update'])->middleware('auth');

// Delete Listing
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single Listing
Route::get('/listings/{id}',[ListingController::class, 'show']);

// Regiter User
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Store User Info
Route::post('/users', [UserController::class, 'store']);

// user logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// user login
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// user authentication
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
