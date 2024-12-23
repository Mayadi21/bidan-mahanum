<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::with('category')->user(auth()->user()->id);

        if(request('status')){

            $status = request('status');

            switch($status){
                case 'published':
                    $post->notHidden()->status('published');
                    break;
                case 'draft':
                    $post->notHidden()->status('draft');
                    break;
                case 'hidden':
                    $post->hidden();
                    break;
            }

        } else {
            $post->notHidden()->status('published');
        }

        if (request('search')) {
            $search = request('search');
            $post->search($search);
        }

        return view('dashboard.posts.index', [
            'page' => 'All Posts',
            'active' => 'posts',
            'posts' => $post->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create',[
            'page' => 'Create Post',
            'active' => 'posts',
            'categories' => Category::orderByRaw("category_name = 'Others' ASC")->orderBy('category_name', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'image' => 'nullable|image|file|max:2048',
            'category_id' => 'required',
            'status' => 'required'
        ]);
        
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200, '...');
        $validatedData['view'] = 0;

        Post::create($validatedData);

        return redirect('dashboard/posts')->with('success', 'New Post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'page'=> $post->title,
            'active' => 'posts',
            'post'=> $post,
            'comments' => $post->comments()->orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'page' => 'Edit Post',
            'active' => 'posts',
            'post' => $post,
            'categories' => Category::orderByRaw("category_name = 'Others' ASC")->orderBy('category_name', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required',
            'status'=> 'required'
        ];
        
        $validatedData = $request->validate($rules);
        
        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        
        
        if($request->slug != $post->slug) {
            $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);
        }
        
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200, '...');
        
        Post::where('id', $post->id)
            ->update($validatedData)
        ;

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/dashboard/posts')->with('success', 'Post deleted successfully');
    }
}