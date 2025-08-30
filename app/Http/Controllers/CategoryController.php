<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('Categories.index', compact('categories'));
    }

    public function create(){
        return view('Categories.create');
    }

    public function store(CategoryRequest $request){
        $category = CategoryRepository::storeByRequest($request);
        return to_route('category.index')->withSuccess('Category created successfully');
    }

    public function edit(Category $category){
        return view('Categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category){
        $categories = CategoryRepository::updateByRequest($request, $category);
        return to_route('category.index')->withSuccess('Category updated successfully');
    }

   public function destroy(Category $category)
{
    $media = $category->media;
    if ($media && Storage::exists($media->src)) {
        Storage::delete($media->src);
        $media->delete(); 
    }
    $category->delete();

    return to_route('category.index')->with('success', 'Category deleted successfully');
}

}