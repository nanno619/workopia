<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ApplicantController;

Route::get('/', function () {
    return view('welcome');
});
//
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::resource('jobs', JobController::class);

/**
 *  Creates resource routes for actions that require authentication
 *  ->only(['create','edit','update','destroy']) restricts to specific actions:
 *  create - GET /jobs/create (show create form)
 *  store - POST /jobs
 *  edit - GET /jobs/{job}/edit (show edit form)
 *  update - PUT/PATCH /jobs/{job} (process updates)
 *  destroy - DELETE /jobs/{job} (delete job)
**/
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);

/**
 *  Creates resource routes for public access (no authentication required)
 *  This leaves only:
 *  index - GET /jobs (list all jobs)
 *  show - GET /jobs/{job} (show single job)
 */
Route::resource('jobs', JobController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);

// Guest middleware - if user already logged in, there is no point that the authenticted user can go to the login page. there is where guest middleware comes in. This middleware ensures only unauthenticated users can access this route
Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::middleware('auth')->group(function() {
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});

Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])->name('applicant.store')->middleware('auth');

/******* Helper */
Route::get('routes', function () {
    // phpinfo();
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%'>";
    echo '<tr>';
    echo "<td width='10%'><h4>HTTP Method</h4></td>";
    echo "<td width='10%'><h4>Route</h4></td>";
    echo "<td width='10%'><h4>Name</h4></td>";
    echo "<td width='70%'><h4>Corresponding Action</h4></td>";
    echo '</tr>';
    foreach ($routeCollection as $value) {
        echo '<tr>';
        echo '<td>'.$value->methods()[0].'</td>';
        echo '<td>'.$value->uri().'</td>';
        echo '<td>'.$value->getName().'</td>';
        echo '<td>'.$value->getActionName().'</td>';
        echo '</tr>';
    }
    echo '</table>';
});

/******************************************** */

// Route Params
Route::get('/posts/{id}', function(string $id){ //closure function. string $id is type-hint
    return "Post " . $id;
})->whereNumber('id'); // Route constraints. URL: https://laravel.com/docs/12.x/routing#parameters-regular-expression-constraints

// Multiple Route Params
Route::get('/posts/{id}/comments/{commentId}', function(string $id, string $commentId){
    return "Post " . $id . " Comment " . $commentId;
});

/**
 * Global constraint (for testing)
 * 1. Go to app/Providers/AppServiceProvider.php
 * 2. Import Route facade
 * use Illuminate\Support\Facades\Route;
 * 3. Add this in boot()
 * Route::pattern('id', '[0-9]+');
 */


/******************* ************************/
Route::get('/test', function(){
    $url = route('jobs');
    return "<a href='$url'>Click Me</a>";
});

// Retun JSON Data
Route::get('/api/users', function(){
    return [
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ];
});

/**
 * We will test this with curl.
 * 1.Open your terminal
 * 2.Run this command
 * curl -X POST https://workopia.test/submit
 * 3.You will get 419 error.
 * Why? Because laravel has built-in protection for Cross Site Request Forgery (CSRF)
 * So, when we create form in views, we have to add @csrf. So, laravel will know the form comes from your site.
 *
 * For testing purpose:
 * 1.Go to bootstrap/app.php
 * 2.Add this in the callback function
 * $middleware->validateCsrfTokens(except:['/submit']);
 * 3.Run this command
 * curl -X POST https://workopia.test/submit
 *
 *
 */
// Route::post('/submit', function(){
//     return 'Submitted';
// });

// Route::match
// Route::match(['get','post'], '/submit', function(){
//     return 'Submitted';
// });

// Route::any
/**
 * 1.Test in terminal.
 * 2.Run this command
 * curl -X DELETE https://workopia.test/submit
 * curl -X PUT https://workopia.test/submit
 */
Route::any('/submit', function(){
    return 'Submitted';
});
