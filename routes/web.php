<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controllers\HomeController::class, 'index'])->name('homepage');

//Post
Route::get('/posts', [Controllers\FrontendPostController::class, 'index'])->name('frontend.posts');
Route::get('/posts/{post:slug}', [Controllers\FrontendPostController::class, 'show'])->name('frontend.posts.show');
Route::get('/post/search', [Controllers\FrontendPostController::class, 'search'])->name('frontend.posts.search');
Route::get('/posts/author/{name}', [Controllers\UserController::class, 'show'])->name('authors.posts.show');

//Tour Package
Route::get('/packages', [Controllers\PackageController::class, 'index'])->name('frontend.tour-packages');
Route::get('/package/search', [Controllers\PackageController::class, 'search'])->name('frontend.tour-packages.search');
//Order Package
Route::get('/packages/order/{slug}', [Controllers\PackageController::class, 'showForm'])->name('order.form');
Route::post('/packages/order', [Controllers\PackageController::class, 'submitOrder'])->name('order.submit');

//Authenticate
Route::middleware('auth')->group(function () {
    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    //User Role
    Route::middleware('role:user')->group(function () {

    });

    //Admin Role
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('dashboard', [Controllers\AdminController::class, 'index'])->name('dashboard');
        Route::resource('home-settings', Controllers\AdminController::class)->except(['index', 'destroy', 'deleteImage']);
        Route::delete('/home-settings/{homeSetting}/delete-image', [Controllers\AdminController::class, 'deleteImage'])->name('home-settings.delete-image');
        Route::delete('/home-settings/{homeSetting}', [Controllers\AdminController::class, 'destroy'])->name('home-settings.destroy');

        Route::resource('/posts', Controllers\PostController::class)->except(['edit', 'show', 'destroy', 'search']);
        Route::get('/posts/search', [Controllers\PostController::class, 'search'])->name('post.search');
        Route::get('/posts/{post:slug}/edit', [Controllers\PostController::class, 'edit'])->name('posts.edit');
        Route::get('/posts/{post:slug}', [Controllers\PostController::class, 'show'])->name('posts.show');
        Route::delete('/posts/{post:slug}/delete', [Controllers\PostController::class, 'destroy'])->name('posts.destroy');
        Route::post('/posts/{post:slug}/comments', [Controllers\CommentController::class, 'store'])->name('comments.store');

        Route::resource('/tour-packages', Controllers\TourPackageController::class)->except(['show', 'edit', 'destroy', 'search']);
        Route::get('/tour-packages/search', [Controllers\TourPackageController::class, 'search'])->name('tour-packages.search');
        Route::get('/tour-packages/{tourPackage:slug}/edit', [Controllers\TourPackageController::class, 'edit'])->name('tour-packages.edit');
        Route::get('/tour-packages/{tourPackage:slug}', [Controllers\TourPackageController::class, 'show'])->name('tour-packages.show');
        Route::delete('/tour-packages/{tourPackage:slug}/delete', [Controllers\TourPackageController::class, 'destroy'])->name('tour-packages.destroy');

        Route::resource('/orders', Controllers\OrderController::class);

        Route::get('/image-manager', [Controllers\ImageManagerController::class, 'index'])->name('image.manager');
        Route::post('/image-manager/upload', [Controllers\ImageManagerController::class, 'upload'])->name('image.manager.upload');
        Route::delete('/image-manager/delete', [Controllers\ImageManagerController::class, 'delete'])->name('image.manager.delete');

        Route::get('/carousel', [Controllers\CarouselController::class, 'index'])->name('carousel.index');
        Route::get('/carousel/create', [Controllers\CarouselController::class, 'create'])->name('carousel.create');
        Route::post('/carousel', [Controllers\CarouselController::class, 'store'])->name('carousel.store');
        Route::get('/carousel/{carousel}/edit', [Controllers\CarouselController::class, 'edit'])->name('carousel.edit');
        Route::put('/carousel/{carousel}', [Controllers\CarouselController::class, 'update'])->name('carousel.update');
        Route::delete('/carousel/{carousel}', [Controllers\CarouselController::class, 'destroy'])->name('carousel.destroy');

    });
    Route::get('/images/list', [Controllers\PostController::class, 'list'])->name('images.list');
});

require __DIR__ . '/auth.php';