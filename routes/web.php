<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    $document = YamlFrontMatter::parseFile(
        resource_path('posts/my-third-post.html')
    );

//    ddd($document);
    return view('posts' , ['posts' => Post::all()]);
});
//dd("File not exists"); // dump, die
// ddd() : dump, die, debug

Route::get('posts/{post}', function ($slug) {

    return view('post', [
        'post' => Post::find($slug)
    ]);

})->where('post', '[A-z_\-]+');


Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');
