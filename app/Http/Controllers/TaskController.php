<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::where('user_id', auth()->id)    
                    ->get();

        return response()->json($tasks, 200);
    }

 
    public function create(TaskStoreRequest $request)
    {
        $task = Task::create($request->validated());

        return response()->json([
            'success' => true,
            'task' => $task,
        ], 201);
    }

    public function destroy($idTask) {
        Task::destroy($idTask);
        return response()->json([
            'success' => true,
        ], 200);
    }

    public function updateCompleted(Task $task) {

        $task->completed = !$task->completed;   
        $task->save();

        return response()->json([
            'success' => true,
            'task' => $task,
        ], 200);
    }
}
