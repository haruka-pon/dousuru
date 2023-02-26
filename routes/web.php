<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;

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

Route::redirect('/', '/tweet');
Route::resource('/tweet', TweetController::class);

Route::get('/Controllers/TweetController', [TweetController::class, 'countUp']);
Route::post('/Controllers/TweetController', [TweetController::class, 'countUp']);