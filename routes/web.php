<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});
//
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/jobs/share', [JobController::class, 'share']);

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

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
