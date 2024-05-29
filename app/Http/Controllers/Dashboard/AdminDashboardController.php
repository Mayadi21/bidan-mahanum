<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
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
            ->get()
        ;

        return view('dashboard.admin-index', [
            'page' => 'Admin Dashboard',
            'active' => 'admin-dashboard',
            'posts' => $posts
        ]);
    }
}
