<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderByRaw("category_name = 'Others' ASC")->orderBy('category_name')->get();

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
            ->status('published')
            ->notHidden()
            ->hasNotBannedUser()
            ->get()
        ;

        return view('blog.category', [
            'title' => $category->category_name,
            'page' => $category->category_name,
            'posts' => $posts,
            'description' => $category->category_description,
            'active' => 'categories'
        ]);
    }    
}