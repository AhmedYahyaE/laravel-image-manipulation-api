<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Postman notes:
// Note: In Postman, for ALL our API requests, we added two HTTP Request Headers (in the 'Headers' tab in Postman):    Accept: application/json    and    Content-Type: application/json
// We use "Bearer Token" Type for all requests in Postman

// Note: We used Laravel Breeze package for Login and Registration implementation
// Note: We used Laravel Sanctum package for generating access tokens (access token authentication system)
// Note: All API routes/URLs/endpoints automatically start with '/api' like www.example.com/api/xxxx. That's because we're using Laravel 'api.php' file.



// Our API Endpoints (routes):
// Laravel Sanctum (access token authentication system). We used Laravel Sanctum package for generating access tokens (access token authentication system)    // Laravel Sanctum: https://laravel.com/docs/9.x/sanctum
Route::middleware('auth:sanctum')->group(function() { // Our Sanctum Authentication System
    // Our API Endpoints (routes):

    // API Versioning (v1, v2, v3, ...) using Route Prefixes:
    Route::prefix('v1')->group(function() { // Prefix all the routes with a given URI (prefix all the API routes or endpoints with 'v1'    // Route Prefixes: https://laravel.com/docs/9.x/routing#route-group-prefixes
        // AlbumController
        Route::apiResource('album', \App\Http\Controllers\V1\AlbumController::class); // All the album routes (create an album (POST), get all albums (of the authenticated/logged-in user) (GET), get a single album (of the authenticated/logged-in user) (GET), update an album (PUT/PATCH), delete an album (DELETE), ...)    // Note: The apiResource() function: With API routes, routes that generate HTML like create() method (which renders the create HTML Form) and edit() method (which renders the edit/update HTML Form) are not need, because APIs return JSON only. The apiResource() method is used to automatically exclude these two routes. The apiResource() function automatically generate the following routes:     GET /users - index() - List all users     ,     POST /users - store() - Create a new user     ,     GET /users/{user} - show() - Retrieve a specific user     ,     PUT /users/{user} - update() - Update a specific user     ,     DELETE /users/{user} - destroy() - Delete a specific user

        // ImageManipulationController
        Route::get('image', [\App\Http\Controllers\V1\ImageManipulationController::class, 'index']); // Get all images (that belong to the authenticated/logged-in user ONLY)
        Route::get('image/by-album/{album}', [\App\Http\Controllers\V1\ImageManipulationController::class, 'byAlbum']); // Get image by album (that belong to the authenticated/logged-in user ONLY)
        Route::get('image/{image}', [\App\Http\Controllers\V1\ImageManipulationController::class, 'show']); // Get a Single image (that belongs to the authenticated/logged-in user ONLY)
        Route::post('image/resize', [\App\Http\Controllers\V1\ImageManipulationController::class, 'resize']); // resize an image (whether By URL or image upload, and whether by px or %)
        Route::delete('image/{image}', [\App\Http\Controllers\V1\ImageManipulationController::class, 'destroy']); // delete an image (that belongs to the authenticated/logged-in user ONLY)
    });
});