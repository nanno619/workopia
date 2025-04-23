<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', function(){

    $title = 'Available Jobs';
    $jobs = [
        'Web Developer',
        'Database Admin',
        'Software Engineer',
        'System Analyst',
    ];
    return view('jobs.index', compact('title', 'jobs'));
})->name('jobs'); // ->name() is NAMED ROUTE

Route::get('/jobs/create', function(){

    return view('jobs.create');
})->name('jobs.create');


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
