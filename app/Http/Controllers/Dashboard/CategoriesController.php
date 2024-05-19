<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Comment;
use App\Http\Requests\StoreCategoryRequest;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
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

        return redirect('dashboard/categories')->with('success', 'New Category has been added!');
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
        return view('dashboard.categories.edit',[
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

        return redirect('/dashboard/categories')->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Storage::delete($category->image);
        $category->delete();
        
        return redirect('/dashboard/categories')->with('success', 'Category deleted successfully');
    }
}
