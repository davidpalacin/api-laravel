<?php

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
Route::post("tasks", function (Request $request, Response $response) {
    try {
        // Recibimos del body la información
        $title = $request->input('title');
        $description = $request->input('description');

        // Guardar en la bd:
        $task = new Task();
        $task->title = $title;
        $task->description = $description;
        $task->save();

        // devolver resultado satisfactorio:
        return response([
            "success" => true,
            "message" => "Task created successfully",
            "data" => [
                "task" => $task
            ]
        ], 200);

    } catch (\Throwable $th) {
        // Controlar el error
        return response([
            "success" => false,
            "message" => "Cannot create task: " . $th->getMessage(),
        ], 500);
    }
});

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
