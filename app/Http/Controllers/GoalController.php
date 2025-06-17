<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalStoreRequest;
use App\Models\Category;
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

    public function getProgress(Request $request)
    {
        $goal = Goal::with('category')
                    ->find($request->query('goalId', null));

        if ($goal) {
            $category = $goal->category;
        } else if ($request->has('categoryId')) {
            $category = Category::find($request->query('categoryId'));
        } else {
            return response()->json([
                'message' => 'Goal or Category not found',
            ], 404);
        }

        $progress = [
            'goal' => [
                'id' => $goal->id ?? null,
                'percentage' => $goal->percentage ?? 0,
            ],
            'category' => [
                'id' => $category->id,
                'percentage' => $category->percentage,
            ]
        ];

        return response()->json([
            'success' => true,
            'progress' => $progress
        ], 201);
    }
}
