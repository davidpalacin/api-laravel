<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {
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
    }

    public function getAllTasks()
    {
        try {
            $tasks = Task::all();
            return response([
                "success" => true,
                "message" => "Tasks retrieved successfully",
                "data" => [
                    "task" => $tasks
                ]
            ], 200);
        } catch (\Throwable $th) {
            // Controlar el error
            return response([
                "success" => false,
                "message" => "Cannot get tasks: " . $th->getMessage(),
            ], 500);
        }
    }

    // devolver tarea por id
    public function getTaskById($id)
    {
        try {
            // funcion eloquent busca la tarea y devolver json
            $task = Task::where('id', $id)
                ->get();
                
            return response([
                "success" => true,
                "message" => "Task retrieved successfully",
                "data" => [
                    "task" => $task
                ]
            ], 200);
        } catch (\Throwable $th) {
            // Controlar el error
            return response([
                "success" => false,
                "message" => "Cannot find task: " . $th->getMessage(),
            ], 500);
        }
    }
}
