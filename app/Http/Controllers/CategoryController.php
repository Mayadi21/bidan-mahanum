<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_name')->get();
        return view('blog.categories', [
            'categories' => $categories,
            'title' => 'All Categories',
            'page' => 'All Categories',
            'active' => 'categories'
        ]);
    }

    public function show(Category $category)
    {
        $posts = $category->posts()
            ->where('status', 'published')
            ->whereNull('report_id')
            ->whereHas('user', function ($query) {
                $query->whereNull('report_id');
            })
            ->get()
        ;

        return view('blog.category', [
            'title' => $category->category_name,
            'page' => $category->category_name,
            'posts' => $posts,
            'active' => 'categories'
        ]);
    }    
}