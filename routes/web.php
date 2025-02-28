<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\YourController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\mapController;
use App\Http\Controllers\LocentryController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [TestController::class, 'getTest'])->name('home'); // ホームページ
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // ログインフォーム
Route::post('/login', [AuthController::class, 'login']); // ログイン処理
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // ログアウト
Route::get('/test', [TestController::class, 'getTestPage'])->name('test');
Route::get('/mypage', [YourController::class, 'showMypage'])->name('mypage')->middleware('auth');


//地図と地図の登録関連
Route::get('map',[MapController::class,'index'])->name("map");
Route::get('map/reserve', [MapController::class, 'reserve'])->name('reserve');
Route::get('map/reserve/checkout', [MapController::class, 'checkout'])->name('checkout');
Route::get('locentryform',[LocentryController::class,'create'])->name('form');
Route::post('locentryform/store',[LocentryController::class,'store'])->name('store');
Route::post('map/reserve/checkout/submit', [MapController::class, 'submit'])->name('submit');

Route::get('/location', function () {return view('location');})->name('location');
Route::get('/discover', function () {return view('discover');})->name('discover');
Route::get('/bookings', function () {return view('bookings');})->name('bookings');
Route::get('/activities', function () {return view('activities');})->name('activities');
Route::get('/about', function () {return view('about');})->name('about');
Route::get('/contact', function () {return view('contact');})->name('contact');
