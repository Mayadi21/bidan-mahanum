<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderByRaw("category_name = 'Others' ASC");

        if(request('search')) {
            $search = request('search');
            $categories = $categories->search($search)->paginate(10);
        } else {
            $categories = $categories->paginate(10);
        }

        return view('dashboard.admin-categories.index', [
            'page' => 'All Categories',
            'active' => 'admin-categories',
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.admin-categories.create', [
            'page' => 'Create Category',
            'active' => 'admin-categories'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|file|max:2048',
            'category_name' => 'required',
            'category_description' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('category-images');
        }
        
        $validatedData['category_slug'] = SlugService::createSlug(Category::class, 'category_slug', $request->category_name);

        Category::create($validatedData);

        return redirect(route('categories.index'))->with('success', 'New Category has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return view('dashboard.categories.show', [
            'category'=> $category,
            'comments' => $category->comments()->orderBy('created_at', 'desc')->get(),
            'page'=> $category->title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category_slug)
    {
        $category = Category::where('category_slug', $category_slug)->firstOrFail(); // Mengambil data post dari database berdasarkan slug

        return view('dashboard.admin-categories.edit', [
            'page' => 'Edit Category',
            'active' => 'admin-categories',
            'category'=>$category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'image' => 'nullable|image|file|max:2048',
            'category_name' => 'required',
            'category_description' => 'required'
        ];
        
        $validatedData = $request->validate($rules);
        
        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage); // menghapus gambar lama dari folder storage
            }
            $validatedData['image'] = $request->file('image')->store('category-images'); // menyimpan di storage/app/public/post-images
        }
        
        if($request->category_slug != $category->category_slug) {
            $validatedData['category_slug'] = SlugService::createSlug(Category::class, 'category_slug', $request->category_name);
        }
        
        Category::where('id', $category->id)
            ->update($validatedData)
        ;

        return redirect(route('categories.index'))->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->image) {
            Storage::delete($category->image);
        }
        $category->delete();
        
        return redirect(route('categories.index'))->with('success', 'Category deleted successfully');
    }
}
