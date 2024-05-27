<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
{
    public function index()
    {
        // Mengambil data user yang active
        $users = User::where('role', 'user')->whereNull('report_id')->get();
    
        // Mengambil data jumlah laporan postingan dan komentar untuk setiap pengguna
        $userReports = $this->getUserReports($users);

        // Mengambil data admin
        $admins = User::where('role', 'admin')->get();

        // Mengambil data user yang sudah di-ban
        $bannedUsers = User::whereNotNull('report_id')->get();

        $reports = Report::all();
    
        return view('dashboard.admin-users.index', [
            'page' => 'Admin Users',
            'active' => 'admin-users',
            'users' => $users,
            'admins' => $admins,
            'bannedUsers' => $bannedUsers,
            'userReports' => $userReports,
            'reports' => $reports,
        ]);
    }

    public function show(User $user)
    {
        return view('dashboard.admin-users.detail', [
            'page' => 'Admin Users',
            'active' => 'admin-users',
            'user' => $user,
            'hiddenPosts' => $user->posts()->whereNotNull('report_id')->get(),
            'hiddenComments' => $user->comments()->whereNotNull('report_id')->get(),
        ]);
    }

    public function ban(Request $request, $username)
    {
        // Validasi input
        $request->validate([
            'report_id' => 'required|exists:reports,id',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $username)->firstOrFail();

        // Update report_id user
        $user->report_id = $request->input('report_id');
        $user->save();

        return redirect()->back()->with('success', 'User has been banned successfully.');
    }

    public function hiddenPosts(User $user, Post $post)
    {
        return view('dashboard.posts.show', [
            'page' => $post->title,
            'active' => 'admin-users',
            'post' => $post,
            'comments' => $post->comments
        ]);
    }

    public function hiddenComments(User $user, Comment $comment)
    {
        return view('dashboard.comments.show', [
            'page' => 'Comment',
            'active' => 'admin-users',
            'comment' => $comment
        ]);
    }

    public function role(User $user)
    {
        if ($user->role == 'user') {
            $user->role = 'admin';
            $user->save();
            return redirect()->back()->with('success', 'User role has been changed to admin.');
        } 
        elseif ($user->role == 'admin') {
            $user->role = 'user';
            $user->save();
            return redirect()->back()->with('success', 'Admin role has been changed to user.');
        } 
        else {
            return redirect()->back()->with('error', 'Invalid user role.');
        }
    }

    public function destroy($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $user->delete();

        return redirect()->back()->with('success', 'User has been deleted successfully.');
    }
    


// Fungsi baru untuk menghitung jumlah report postingan dan komentar pengguna
    private function getUserReports($users)
    {
        $userReports = [];

        foreach ($users as $user) {
            $hiddenPostsCount = $user->posts()->whereNotNull('report_id')->count();
            $hiddenCommentsCount = $user->comments()->whereNotNull('report_id')->count();

            $userReports[$user->id] = [
                'hiddenPostsCount' => $hiddenPostsCount,
                'hiddenCommentsCount' => $hiddenCommentsCount,
            ];
        }

        return $userReports;
    }
}
