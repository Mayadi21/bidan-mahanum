<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'category')
            ->where('status', 'published')
            ->whereNull('report_id')
            ->whereHas('user', function ($query) {
                $query->whereNull('report_id');
            })
            ->orderBy('view', 'desc')
            ->get()
        ;

        return view('dashboard.admin-index', [
            'page' => 'Admin Dashboard',
            'active' => 'admin-dashboard',
            'categories' => Category::all(),
            'users' => User::whereNull('report_id')->get(),
            'posts' => $posts
        ]);
    }
}
