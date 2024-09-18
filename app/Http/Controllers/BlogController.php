<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->only(['create']);
    // }
    // public static function middleware(): array
    // {

    //     return [
    //         new Middleware(middleware: 'auth', only: ['create']),
    //     ];

    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            $categories = Category::get();
            return view('them.blogs.create', compact('categories'));
        }
        // redirect('them.login');
        abort(403);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        //1)get image
        $image = $request->image;
        //2)change it's current name
        $newImageName = time() . '-' . $image->getClientOriginalName();
        //3)move image to my project
        $image->storeAs('blogs', $newImageName, 'public');
        //4) save new name to data base record
        $data['image'] = $newImageName;
        $data['user_id'] = Auth::user()->id;
        //create new blog record
        Blog::create($data);
        return back()->with('status', 'Your Blog Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('them.singleBlog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {

        if ($blog->user_id == Auth::user()->id) {
            $categories = Category::get();
            return view('them.blogs.edit', compact('categories', 'blog'));

        }
        // redirect('them.login');
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        // dd($request->all());
        $data = $request->validated();
        if ($request->hasFile('image')) {
            //0)delete old image
            Storage::delete("public/blogs/$blog->image");
            //1)get image
            $image = $request->image;
            //2)change it's current name
            $newImageName = time() . '-' . $image->getClientOriginalName();
            //3)move image to my project
            $image->storeAs('blogs', $newImageName, 'public');
            //4) save new name to data base record
            $data['image'] = $newImageName;

        }
        //Update blog record
        $blog->update($data);
        return back()->with('status', 'Your Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        Storage::delete("public/blogs/$blog->image");
        $blog->delete();
        return back()->with('status', 'Your Blog Deleted Successfully');
    }

    //Display My Blogs
    public function myBlogs(Blog $blog)
    {
        if (Auth::check()) {
            $blogs = Blog::where('user_id', Auth::user()->id)->paginate(10);
            return view('them.blogs.my-blogs', compact('blogs'));
        }
        abort(403);

    }
}
