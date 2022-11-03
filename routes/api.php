<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use App\Http\Controllers\Api\v1\LanguagesController;
use App\Http\Controllers\Api\v1\TranslationsController;
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

/** @var $router Router */
$router->group(['prefix' => 'v1'], function() use ($router){
    $router->get('/languages', [LanguagesController::class, 'get']);
    $router->get('/translations', [TranslationsController::class, 'get']);
    $router->post('/translation', [TranslationsController::class, 'set']);
    $router->delete('/translation/{translation_id}', [TranslationsController::class, 'delete']);
});
