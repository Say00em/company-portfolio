<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SociallinkController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WebinfoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//UI Routes
Auth::routes();


//============== Front End ==============//

Route::get('/', [HomeController::class, 'index'])->name('home');



//========= BackEnd Controllers =========//

Route::group(['middleware' => 'auth'], function () {
    
    //Code Will Be Execute
    
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::resources([
    'user'          => UserController::class,
    'category'      => CategoryController::class,
    'blog'          => BlogController::class,
    'team'          => TeamController::class,
    'service'       => ServiceController::class,
    'sociallink'    => SociallinkController::class,
    'webinfo'       => WebinfoController::class,
    'product'       => ProductController::class,
    'project'       => ProjectController::class,
]);
