<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MainSliderController;
use App\Http\Controllers\ReviewSliderController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\VideoController;
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

Route::get('/', function () {
    return view('front.home', ['active' => 'home']);
})->name('home');


Route::get('/catalog', [FrontPageController::class, 'catalog'])->name('catalog');
Route::get('/catalog/product/{slug}', [FrontPageController::class, 'productDetail'])->name('product.detail');

/* Authentication Routes... */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes([
    'register' => false, // Register Routes...
    'reset' => false, // Reset Password Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::middleware(['auth', 'login-check'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/admin/category/add', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/admin/category/{id}/update', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.delete');

    Route::get('/admin/harga', [HargaController::class, 'index'])->name('admin.harga');
    Route::get('/admin/harga/add', [HargaController::class, 'create'])->name('admin.harga.create');
    Route::post('/admin/harga/store', [HargaController::class, 'store'])->name('admin.harga.store');
    Route::get('/admin/harga/{id}/edit', [HargaController::class, 'edit'])->name('admin.harga.edit');
    Route::put('/admin/harga/{id}/update', [HargaController::class, 'update'])->name('admin.harga.update');
    Route::delete('/admin/harga/{id}/delete', [HargaController::class, 'destroy'])->name('admin.harga.delete');

    Route::get('/admin/kegiatan', [KegiatanController::class, 'index'])->name('admin.kegiatan');
    Route::get('/admin/kegiatan/add', [KegiatanController::class, 'create'])->name('admin.kegiatan.create');
    Route::post('/admin/kegiatan/store', [KegiatanController::class, 'store'])->name('admin.kegiatan.store');
    Route::get('/admin/kegiatan/{id}/edit', [KegiatanController::class, 'edit'])->name('admin.kegiatan.edit');
    Route::put('/admin/kegiatan/{id}/update', [KegiatanController::class, 'update'])->name('admin.kegiatan.update');
    Route::delete('/admin/kegiatan/{id}/delete', [KegiatanController::class, 'destroy'])->name('admin.kegiatan.delete');
    Route::delete('admin/kegiatan/{id}/delete-image', [KegiatanController::class, 'deleteImage'])->name('admin.kegiatan.delete-image');
    Route::get('admin/kegiatan/{id}', [KegiatanController::class, 'show'])->name('admin.kegiatan.show');

    Route::get('/admin/tipe', [TipeController::class, 'index'])->name('admin.tipe');
    Route::get('/admin/tipe/add', [TipeController::class, 'create'])->name('admin.tipe.create');
    Route::post('/admin/tipe/store', [TipeController::class, 'store'])->name('admin.tipe.store');
    Route::get('/admin/tipe/{id}/edit', [TipeController::class, 'edit'])->name('admin.tipe.edit');
    Route::put('/admin/tipe/{id}/update', [TipeController::class, 'update'])->name('admin.tipe.update');
    Route::delete('/admin/tipe/{id}/delete', [TipeController::class, 'destroy'])->name('admin.tipe.delete');

    Route::get('/admin/alat', [AlatController::class, 'index'])->name('admin.alat');
    Route::get('/admin/alat/add', [AlatController::class, 'create'])->name('admin.alat.create');
    Route::post('/admin/alat/store', [AlatController::class, 'store'])->name('admin.alat.store');
    Route::get('/admin/alat/{id}/edit', [AlatController::class, 'edit'])->name('admin.alat.edit');
    Route::put('/admin/alat/{id}/update', [AlatController::class, 'update'])->name('admin.alat.update');
    Route::delete('/admin/alat/{id}/delete', [AlatController::class, 'destroy'])->name('admin.alat.delete');


    Route::get('/admin/catalog', [CatalogController::class, 'index'])->name('admin.catalog');
    Route::get('/admin/catalog/add', [CatalogController::class, 'create'])->name('admin.catalog.create');
    Route::post('/admin/catalog/store', [CatalogController::class, 'store'])->name('admin.catalog.store');
    Route::get('/admin/catalog/{id}/show', [CatalogController::class, 'show'])->name('admin.catalog.show');
    Route::get('/admin/catalog/{id}/edit', [CatalogController::class, 'edit'])->name('admin.catalog.edit');
    Route::put('/admin/catalog/{id}/update', [CatalogController::class, 'update'])->name('admin.catalog.update');
    Route::delete('/admin/catalog/{id}/delete', [CatalogController::class, 'destroy'])->name('admin.catalog.delete');
    Route::delete('/admin/catalog/{id}/delete-image', [CatalogController::class, 'destroyImage'])->name('admin.catalog.delete-image');

    Route::get('/admin/gallery', [CatalogController::class, 'gallery'])->name('admin.gallery');


    Route::get('/admin/video', [VideoController::class, 'index'])->name('admin.video');
    Route::get('/admin/video/add', [VideoController::class, 'create'])->name('admin.video.create');
    Route::post('/admin/video/store', [VideoController::class, 'store'])->name('admin.video.store');
    Route::delete('/admin/video/{id}/delete', [VideoController::class, 'destroy'])->name('admin.video.delete');

    Route::get('/admin/information', [InformationController::class, 'index'])->name('admin.information');
    Route::get('/admin/information/add', [InformationController::class, 'create'])->name('admin.information.create');
    Route::post('/admin/information/store', [InformationController::class, 'store'])->name('admin.information.store');
    Route::delete('/admin/information/{id}/delete', [InformationController::class, 'destroy'])->name('admin.information.delete');

    Route::get('/admin/main-slider', [MainSliderController::class, 'index'])->name('admin.main-slider');
    Route::get('/admin/main-slider/add', [MainSliderController::class, 'create'])->name('admin.main-slider.create');
    Route::post('/admin/main-slider/store', [MainSliderController::class, 'store'])->name('admin.main-slider.store');
    Route::get('/admin/main-slider/{id}/edit', [MainSliderController::class, 'edit'])->name('admin.main-slider.edit');
    Route::put('/admin/main-slider/{id}/update', [MainSliderController::class, 'update'])->name('admin.main-slider.update');
    Route::delete('/admin/main-slider/{id}/delete', [MainSliderController::class, 'destroy'])->name('admin.main-slider.delete');

    Route::get('/admin/review-slider', [ReviewSliderController::class, 'index'])->name('admin.review-slider');
    Route::get('/admin/review-slider/add', [ReviewSliderController::class, 'create'])->name('admin.review-slider.create');
    Route::post('/admin/review-slider/store', [ReviewSliderController::class, 'store'])->name('admin.review-slider.store');
    Route::get('/admin/review-slider/{id}/edit', [ReviewSliderController::class, 'edit'])->name('admin.review-slider.edit');
    Route::put('/admin/review-slider/{id}/update', [ReviewSliderController::class, 'update'])->name('admin.review-slider.update');
    Route::delete('/admin/review-slider/{id}/delete', [ReviewSliderController::class, 'destroy'])->name('admin.review-slider.delete');

    Route::get('/admin/about-us', [AboutUsController::class, 'index'])->name('admin.about-us');
    Route::put('/admin/about-us/{id}/update', [AboutUsController::class, 'update'])->name('admin.about-us.update');

    Route::get('/admin/account-setting', [AdminController::class, 'accountSetting'])->name('admin.account-setting');
    Route::put('/admin/change-password/{id}', [AdminController::class, 'changePassword'])->name('admin.change-password');
    Route::put('/admin/change-information/{id}', [AdminController::class, 'changeInformation'])->name('admin.change-information');
});