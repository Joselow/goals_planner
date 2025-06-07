<?php

namespace App\Listeners;

use App\Events\TaskChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CalculatePercentageGoal
{
   
    public function __construct()
    {
    }
   
    public function handle(TaskChanged $event): void
    {   
        
        $goal = $event->goal;

        if ($goal instanceof \App\Models\Goal) {
            $totalTasks = $goal->tasks()->count();
            $completedTasks = $goal->tasks()->where('completed', true)->count();
    
            $percentageGoal = \App\Utils\CalculatePercentage::calculate($completedTasks, $totalTasks);
            $goal->percentage = $percentageGoal;
            $goal->save();
    
            $category = $goal->category;
        } else if ($goal instanceof \App\Models\Category) {
            $category = $goal;
        }

        $totalGoals = $category->goals()->count();
        $totalGoalsCompleted = $category->goals()->where('percentage', 100)->count();

        $percentageGoal = \App\Utils\CalculatePercentage::calculate($totalGoalsCompleted, $totalGoals);
        $category->percentage = $percentageGoal;
        $category->save();
        // Optionally, you can dispatch an event to notify about the goal update
    }
}
