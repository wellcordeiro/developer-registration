<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\LevelController;

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

#apiRoutes: GET/HEAD, POST, PUT/PATCH, DELETE;
Route::apiResources([
    'developers' => DeveloperController::class,
    'levels' => LevelController::class,
]);

Route::get('/', function () {
    return response()->json([
        'API' => 'API Developer Registration - #DesafioFullStackGazinTech',
        'version' => '1.0.0',
        'author' => 'Welington Borba Cordeiro',
        'email' => 'wellinkeed@gmail.com',
    ]);
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact administrator.'], 404);
});
