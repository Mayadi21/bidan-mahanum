<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latest = Post::where('status', 'published')
            ->whereNull('posts.report_id')
            ->whereHas('user', function ($query) {
                $query->whereNull('report_id');
            })
            ->orderBy('updated_at', 'desc')
            ->take(5)->get()
        ;

        return view('blog.home', [
            'page' => 'Home',
            'title' => 'Home',
            'active' => 'home',
            'latest' => $latest
        ]);
    }

    public function about()
    {
        return view('blog.about', [
            'page' => 'About',
            'title' => 'About'
        ]);
    }

    public function banned()
    {
        if(auth()->check() || auth()->user()->report_id == null) {
            return redirect()->route('home');
        }

        return view('blog.banned', [
            'page' => 'Banned',
            'report_name' => $user->report->report_name,
            'report_description' => $user->report->report_description
        ]);
    }
}
