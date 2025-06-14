<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalStoreRequest;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
  
    public function index(Request $request) {
        $categoryId = $request->query('category_id', null);

        if (empty($categoryId)) {
            return response()->json([
                'message' => 'Category ID is required',
            ], 400);
        }

        $goals = Goal::where('user_id', Auth::user()->id)    
                    ->where('category_id', $categoryId)
                    ->get();

        return response()->json($goals, 200);
    }

 
    public function store(GoalStoreRequest $request)
    {
        $goal = Goal::create($request->all());

        \App\Events\TaskChanged::dispatch($goal);

        return response()->json([
            'success' => true,
            'goal' => $goal,
        ], 201);
    }

    public function destroy(Goal $goal) {
        $category = $goal->category;

        $goal->delete();
        $goal->tasks()->delete();

        \App\Events\TaskChanged::dispatch($category);

        return response()->json([
            'success' => true,
        ], 200);
    }
}
