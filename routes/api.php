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

// Crear tarea:
Route::post("tasks", [TaskController::class, 'createTask']);

Route::put("tasks", function () {
    return "actualizar tarea";
});

Route::delete("tasks/{id}", function ($id) {
    return "Eliminar tarea $id";
});

Route::get("tasks", function () {
    return "todas las tareas";
});

Route::get("tasks/{id}", function ($id) {
    return "Tarea numero $id";
});
