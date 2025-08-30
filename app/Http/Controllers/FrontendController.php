<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FrontendController extends Controller
{
    public function index(){
        $categories = Cache::rememberForever('categories', function(){
            return Category::latest()->get();
        });
        return view('welcome', compact('categories'));
    }
}
