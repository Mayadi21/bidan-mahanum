<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories', [
            'categories' => $categories,
            'title' => 'All Categories',
            'page' => 'All Categories'
        ]);
    }

    public function show(Category $category)
    {
        $posts = $category->posts()->get();
        return view('category', [
            'title' => $category->category_name,
            'page' => $category->category_name,
            'posts' => $posts
        ]);
    }

    
}