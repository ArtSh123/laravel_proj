<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::group(['namespace' => 'App\Http\Controllers\Blog', 'prefix' => 'blog'], function() {
    Route::resource('posts', PostController::class)->names('blog.posts');
});
// admin blog
$groupData = [
    'namespace' => 'App\Http\Controllers\Blog\Admin',
    'prefix' => 'admin/blog'
];

// admin blog categories
Route::group($groupData, function() {
    $methods = ['index', 'edit', 'store', 'update', 'create'];
    Route::resource('categories', CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');
});

// admin blog posts
Route::group($groupData, function() {
    Route::resource('posts', PostController::class)
        ->except(['show'])
        ->names('blog.admin.posts');
});

//Route::resource('rest', RestTestController::class)->names('restTest');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
