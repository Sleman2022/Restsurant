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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::get('/users', [\App\Http\Controllers\UsersController::class, 'index']);
Route::get('/no-menu-users', [\App\Http\Controllers\UsersController::class, 'noMenuUsers']);
Route::put('/change-role', [\App\Http\Controllers\UsersController::class, 'change_role']);

Route::get('/menus', [\App\Http\Controllers\MenusController::class, 'index']);
Route::post('/new-menu', [\App\Http\Controllers\MenusController::class, 'newMenu']);
Route::put('/edit-menu/{id}', [\App\Http\Controllers\MenusController::class, 'updateMenu']);
Route::put('/change-menu-discount/{id}', [\App\Http\Controllers\MenusController::class, 'changeDiscount']);
Route::delete('/delete-menu/{id}', [\App\Http\Controllers\MenusController::class, 'deleteMenu']);

Route::get('/categories', [\App\Http\Controllers\CategoriesController::class, 'index']);
Route::get('/root-categories', [\App\Http\Controllers\CategoriesController::class, 'rootCategories']);
Route::get('/parent-categories', [\App\Http\Controllers\CategoriesController::class, 'parentCategories']);
Route::get('/leaf-categories', [\App\Http\Controllers\CategoriesController::class, 'leafCategories']);
Route::post('/new-category', [\App\Http\Controllers\CategoriesController::class, 'newCategory']);
Route::put('/edit-category/{id}', [\App\Http\Controllers\CategoriesController::class, 'updateCategory']);
Route::put('/change-category-discount/{id}', [\App\Http\Controllers\CategoriesController::class, 'changeDiscount']);
Route::delete('/delete-category/{id}', [\App\Http\Controllers\CategoriesController::class, 'deleteCategory']);

Route::get('/items', [\App\Http\Controllers\ItemsController::class, 'index']);
Route::post('/new-item', [\App\Http\Controllers\ItemsController::class, 'newItem']);
Route::put('/change-item-discount/{id}', [\App\Http\Controllers\ItemsController::class, 'changeDiscount']);
Route::put('/edit-item/{id}', [\App\Http\Controllers\ItemsController::class, 'updateItem']);
Route::delete('/delete-item/{id}', [\App\Http\Controllers\ItemsController::class, 'deleteItem']);

