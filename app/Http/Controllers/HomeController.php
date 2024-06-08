<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latest = Post::status('published')
            ->notHidden()
            ->hasNotBannedUser()
            ->orderBy('updated_at', 'desc')
            ->take(5)->get()
        ;

        $popular = Post::status('published')
            ->notHidden()
            ->hasNotBannedUser()
            ->orderBy('view', 'desc')
            ->take(6)->get()
        ;

        $admin = Post::status('published')
            ->notHidden()
            ->whereHas('user', function ($query) {
                $query->notBanned()
                    ->role('admin');
            })
            ->orderBy('updated_at', 'desc')
            ->take(6)->get()
        ;

        return view('blog.home', [
            'page' => 'Home',
            'title' => 'Home',
            'active' => 'home',
            'latest' => $latest,
            'popular' => $popular,
            'admin' => $admin
        ]);
    }

    public function about()
    {
        return view('blog.about', [
            'page' => 'About',
            'title' => 'About',
            'active' => 'about'
        ]);
    }

    public function banned()
    {
        if (auth()->check() && auth()->user()->report_id !== null) {
            $user = auth()->user();
            return view('blog.banned', [
                'page' => 'Banned',
                'title' => 'Banned',
                'active' => 'banned',
                'report_name' => $user->report->report_name,
                'report_description' => $user->report->report_description,
            ]);
        }

        return redirect()->route('home');
    }
}
