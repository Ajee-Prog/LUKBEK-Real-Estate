<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;

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
Route::get('/services', [PageController::class, 'services']);

Route::get('/', [PropertyController::class, 'index']);
Route::get('/property/{id}', [PropertyController::class, 'show']);

Route::prefix('admin')->group(function () {
    Route::get('/properties/create', [PropertyController::class, 'create']);
    Route::post('/properties/store', [PropertyController::class, 'store']);
});


// _________________________________________________________________
/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/

Route::get('/', [
    HomeController::class,
    'index'
])->name('home');


Route::get('/about', function () {

    return view('frontend.about');

})->name('about');


/*
|--------------------------------------------------------------------------
| PROPERTIES
|--------------------------------------------------------------------------
*/

Route::get('/properties', [
    PropertyController::class,
    'index'
])->name('properties.index');


Route::get('/properties/{property:slug}', [
    PropertyController::class,
    'show'
])->name('properties.show');


/*
|--------------------------------------------------------------------------
| SERVICES
|--------------------------------------------------------------------------
*/

Route::get('/services', [
    ServiceController::class,
    'index'
])->name('services.index');


Route::get('/services/{service:slug}', [
    ServiceController::class,
    'show'
])->name('services.show');


/*
|--------------------------------------------------------------------------
| AGENTS
|--------------------------------------------------------------------------
*/

Route::get('/agents', [
    AgentController::class,
    'index'
])->name('agents.index');


Route::get('/agents/{agent}', [
    AgentController::class,
    'show'
])->name('agents.show');


/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::get('/contact', [
    ContactController::class,
    'index'
])->name('contact');


Route::post('/contact', [
    ContactController::class,
    'store'
])->name('contact.store');


/*
|--------------------------------------------------------------------------
| INSPECTION
|--------------------------------------------------------------------------
*/

Route::get('/book-inspection', [
    BookingController::class,
    'create'
])->name('booking.create');


Route::post('/book-inspection', [
    BookingController::class,
    'store'
])->name('booking.store');
