<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');

// Route::get('/goals', function () {
//     return response()->json([
//         'HELLOw' => 'WORLD',
//     ], 200);
// });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(CategoryController::class)->group(function () {
        Route::post('/categories/create', [CategoryController::class, 'create']);
        Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');
    });

    Route::controller(GoalController::class)->group(function () {
        Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
        Route::apiResource('goal', GoalController::class)->except(['show', 'update', 'index']);
    });

    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::apiResource('task', TaskController::class)->except(['show', 'update', 'index']);
        Route::patch('task/{task}', [TaskController::class, 'updateCompleted'])->name('task.updateCompleted');
    });
});


require __DIR__.'/auth.php';
