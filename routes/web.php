<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyCategoryController;
use App\Http\Controllers\Admin\PropertyFeatureController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\PageController;
// use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;

// use App\Http\Controllers\ServiceController;
// use App\Http\Controllers\AgentController;
// use App\Http\Controllers\BookingController;
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




// ________________ADMIN ROUTE --___ START HERE-------______------
Route::middleware([
    'auth',
    'admin'
])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get('/dashboard', [
        AdminController::class,
        'index'
    ])->name('dashboard');


    Route::resource(
        'properties',
        PropertyController::class
    );


    Route::resource(
        'categories',
        PropertyCategoryController::class
    );


    Route::resource(
        'features',
        PropertyFeatureController::class
    );


    Route::resource(
        'services',
        ServiceController::class
    );


    Route::resource(
        'agents',
        AgentController::class
    );


    Route::resource(
        'bookings',
        BookingController::class
    );


    Route::resource(
        'leads',
        LeadController::class
    );


    Route::resource(
        'messages',
        MessageController::class
    );


    Route::resource(
        'testimonials',
        TestimonialController::class
    );


    Route::resource(
        'users',
        UserController::class
    );


    Route::get('/settings', [
        SettingController::class,
        'index'
    ])->name('settings.index');

    // Images Route start here
        Route::delete(
    'property-images/{image}',
    [
        PropertyController::class,
        'destroyImage'
    ]
)->name('property-images.destroy');


Route::patch(
    'property-images/{image}/primary',
    [
        PropertyController::class,
        'setPrimaryImage'
    ]
)->name('property-images.primary');
    // Image Route ends here

});
// ________________ADMIN ROUTE --___ START HERE-------______------
// Route for enquiry
Route::get(
    '/properties/{property:slug}/interest',
    function (\App\Models\Property $property) {

        abort_if(
            $property->status !== 'available',
            404
        );

        return view(
            'frontend.properties.interest',
            compact('property')
        );
    }
)->name('properties.interest');
// Route for enquiry ends

/*Route::middleware([
    'auth',
    'admin'
])->prefix('admin')->name('admin.')->group(
    function () {

        Route::get(
            '/leads',
            [LeadController::class, 'index']
        )->name('leads.index');


        Route::get(
            '/leads/{lead}',
            [LeadController::class, 'show']
        )->name('leads.show');


        Route::put(
            '/leads/{lead}',
            [LeadController::class, 'update']
        )->name('leads.update');


        Route::get(
            '/inspections',
            [InspectionController::class, 'index']
        )->name('inspections.index');


        Route::get(
            '/inspections/{inspection}',
            [InspectionController::class, 'show']
        )->name('inspections.show');


        Route::put(
            '/inspections/{inspection}',
            [InspectionController::class, 'update']
        )->name('inspections.update');

    }
);*/

