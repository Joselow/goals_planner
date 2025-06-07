<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function create(CategoryStoreRequest $request)
    {
        $validated = $request->all();
        $category = Category::create($validated);
        return response()->json($category, 201);
    }
}
