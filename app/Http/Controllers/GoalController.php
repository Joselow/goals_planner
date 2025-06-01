<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoalStoreRequest;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
  
    public function index() {
        $goals = Goal::where('user_id', auth()->id)    
                    ->get();

        return response()->json($goals, 200);
    }

 
    public function create(GoalStoreRequest $request)
    {
        $goal = Goal::create($request->validated());

        return response()->json([
            'success' => true,
            'goal' => $goal,
        ], 201);
    }

    public function destroy($idGoal) {
        $goal = Goal::destroy($idGoal);
        return response()->json([
            'success' => true,
        ], 200);
    }
}
