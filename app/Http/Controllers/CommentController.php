<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:contacts,email',
            'subject' => 'required|min:4',
            'message' => 'required',
            'blog_id' => 'required|exists:blogs,id',
        ]);
        Comment::create($data);
        return back()->with('status', 'Comment Sent Successfully');
    }
}
