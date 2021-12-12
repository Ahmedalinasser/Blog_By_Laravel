<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Middleware;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// Route::get('/admin', function () {
//     return view('admin.index');
// })->name('admin');

// Route::get('/home', function () {
//     return view('home.index');
// })->name('home');


// Route::get('/post', function () {
//     return view('post.blog_post');
// })->name('post');

Route::get('home',[HomeController::class, 'index'])->name('home');

Route::get('/post/{post}', [PostController::class, 'show'])->name('Post');

Route::middleware(['auth',])->group(function(){

    Route::get('admin',[AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/posts/view',  [PostController::class , 'index'])->name('post.index');

    Route::get('/admin/posts/create', [PostController::class , 'create'])->name('post.create');
    Route::get('/admin/posts/{post}/edit)', [PostController::class , 'edit'])->name('post.edit');

    Route::post('/admin/posts',  [PostController::class , 'store'])->name('post.store');
    Route::delete('/admin/posts/{post}/destroy', [PostController::class , 'destroy'])->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', [PostController::class , 'update'])->name('post.update');
    Route::get('/user/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('/user/{user}/update', [UserController::class, 'update'])->name('user.profile.update');      
    //  Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/admin/user/{user}/destroy', [UserController::class , 'destroy'])->name('user.destroy');      
    Route::put('/user/{user}/attach', [UserController::class , 'attach'])->name('user.role.attach');
    Route::put('/user/{user}/detach', [UserController::class , 'detach'])->name('user.role.detach');
    Route::get('/roles', [RoleController::class , 'index'])->name('roles.index');
    Route::get('/permissions', [PermissionController::class , 'index'])->name('permissions.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::delete('/roles/{role}/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}/update', [RoleController::class, 'update'])->name('roles.update');
    Route::put('/roles/{role}/attach', [RoleController::class , 'attach_permission'])->name('role.permission.attach'); 
    Route::put('/roles/{role}/detach', [RoleController::class , 'detach_permission'])->name('role.permission.detach'); 

    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/permissions/{permission}/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions/{permission}/update', [PermissionController::class, 'update'])->name('permissions.update');



}); 

Route::middleware(['role:Admin','auth'])->group(function (){

    

    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');

});

Route::middleware(['can:view,user'])->group(function (){

    Route::get('/user/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');


});


// Route::get('/admin/posts/{post}/edit)', [PostController::class , 'edit'])
// ->middleware('can:view,post')->name('post.edit');
