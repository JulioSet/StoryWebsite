<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'getHome'])->name('isLogged');

Route::get('/about', [PageController::class, 'getAbout']);
Route::get('/logout', [PageController::class, 'logout'])->name('logout');

Route::get('/login', [PageController::class, 'getLogin']);
Route::post('/login', [PageController::class, 'login'])->name('login');

Route::get('/register', [PageController::class, 'getRegister']);
Route::post('/register', [PageController::class, 'register'])->name('register');

Route::get('/profile', [PageController::class, 'getProfile']);
Route::post('/profile', [PageController::class, 'editProfile'])->name('edit-profile');

Route::get('/feed', [FeedController::class, 'view']);
Route::post('/feed', [FeedController::class, 'search_feed']);
Route::get('/myfeeds', [FeedController::class, 'getMyFeed']);
Route::get('/feed/add', [FeedController::class, 'getCreate']);
Route::post('/feed/add', [FeedController::class, 'createFeed'])->name('create-feed');
Route::get('/feed/edit/{id}', [FeedController::class, 'getEdit']);
Route::post('/feed/edit/{id}', [FeedController::class, 'editFeed']);
Route::get('/feed/detail/{id}', [FeedController::class, 'getDetail']);
Route::get('/feed/bookmark', [FeedController::class, 'getBookmark']);
Route::post('/bookmark/{id}', [FeedController::class, 'bookmark']);
Route::post('/like/{id}', [FeedController::class, 'like']);

Route::get('/admin/users', [AdminController::class, 'getUsers']);
Route::post('/admin/users', [AdminController::class, 'editUser'])->name('edit-user');
Route::get('/admin/feeds', [AdminController::class, 'getFeeds']);
Route::post('/admin/feeds', [AdminController::class, 'editFeed'])->name('edit-feed');
Route::get('/admin/report/membership', [AdminController::class, 'getTransaction']);

Route::get('/membership', [PageController::class, 'buyMembership']);

Route::get('/topup', [PageController::class, 'getTopup']);
Route::post('/topup', [PageController::class, 'topup']);

Route::get('/friend/add', [FriendController::class, 'getAddfriend']);
Route::post('/friend/add/{id}', [FriendController::class, 'add']);
Route::get('/friend/list', [FriendController::class, 'getListfriend']);
