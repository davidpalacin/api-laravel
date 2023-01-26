<?php

/* use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
  return 'Bienvenidos a mi aplicación de tareas';
});

Route::post("tasks", function (Request $request, Response $response) {
  // Recibimos del body la información
  $title = $request->input('title');
  $description = $request->input('description');

  return response("title: $title, desc: $description", 200)
    ->header('Content-Type', 'application/json');
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
 */