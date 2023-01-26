<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {
        try {
            // Crear una validación para requerir los campos:
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required'
            ]);

            if($validator->fails()){
                return response([
                    "success" => false,
                    "message" => $validator->messages()
                ], 400);
            }

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

            /* if(!$task) {
                return response([
                    "success" => true,
                    "message" => "Task does not exist",
                    "data" => $task
                ], 404);
            } */

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

    public function deleteTaskById($id)
    {
        try {
            $taskToDelete = Task::query()->find($id);
            $taskToDelete->delete();
            
            return response([
                "success" => true,
                "message" => "Task deleted successfully",
                "data" => [
                    $taskToDelete
                ]
            ], 200);

        } catch (\Throwable $th) {
            return response([
                "success" => false,
                "message" => "Cannot delete task " . $th->getMessage(),
            ], 500);
        }
    }

    // Actualizar una tarea
    public function updateTask(Request $request, $id)
    {
        try {
            //Encontramos la tarea y actualizar datos
            $taskToUpdate = Task::query()->find($id);
            $taskToUpdate -> title = $request->input('title');
            $taskToUpdate -> description = $request->input('description');

            //Devolvemos el resultado
            return response([
                "success" => true,
                "message" => "Task updated successfully",
                "task" => $taskToUpdate
            ]);
        } catch (\Throwable $th) {
            return response([
                "success" => false,
                "message" => "Failed to update " . $th->getMessage(),
            ]);
        }
    }
}
