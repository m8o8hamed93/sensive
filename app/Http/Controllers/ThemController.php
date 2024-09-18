<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;

class ThemController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(4);
        $sliderBlogs = Blog::latest()->take(5)->get();

        return view('them.index', compact('blogs', 'sliderBlogs'));
    }
    public function contact()
    {
        return view('them.contact');
    }
    public function category($id)
    {
        $categoryName = Category::find($id)->name;
        $blogs = Blog::where('category_id', $id)->paginate(8);
        return view('them.category', compact('blogs', 'categoryName'));
    }

    public function login()
    {
        return view('them.login');
    }
    public function register()
    {
        return view('them.register');
    }
}
