<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request) {

        $tasks = Task::where('goal_id', $request->query('goalId'))    
                    ->get();

        return response()->json($tasks, 200);
    }

 
    public function store(TaskStoreRequest $request)
    {
        $task = Task::create($request->validated());
        
        \App\Events\TaskChanged::dispatch($task->goal);

        return response()->json([
            'success' => true,
            'task' => $task,
        ], 201);
    }

    public function destroy(Task $task) {
        $goal = $task->goal;
        $task->delete();

        \App\Events\TaskChanged::dispatch($goal);
        return response()->json([
            'success' => true,
        ], 200);
    }

    public function updateCompleted(Task $task) {
        $task->completed = !$task->completed;   

        if (boolval($task->completed) === true) {
            $task->observation = 'Task completed on ' . now()->format('d/m/Y H:i:s');
        } else {
            $task->observation = null;
        }

        $task->save();

        \App\Events\TaskChanged::dispatch($task->goal);

        return response()->json([
            'success' => true,
            'task' => $task,
        ], 200);
    }
}
