<?php

use App\Http\Controllers\TaskController;
use App\Models\Task;
use GuzzleHttp\Psr7\Response;
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

Route::get('/', function () {
    return 'Bienvenidos a mi aplicación de tareas';
});

// Todas las tareas:
Route::get("tasks", [TaskController::class, 'getAllTasks']);

// Tarea por id
Route::get("tasks/{id}", [TaskController::class, 'getTaskById']);

// Crear tarea:
Route::post("tasks", [TaskController::class, 'createTask']);

Route::put("tasks", function () {
    return "actualizar tarea";
});

Route::delete("tasks/{id}", function ($id) {
    return "Eliminar tarea $id";
});

