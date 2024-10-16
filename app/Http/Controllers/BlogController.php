<?php

namespace App\Http\Controllers;


use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->get();
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);
        Blog::create($request->all());
        return redirect()->route('blogs.index');
    }

    // Other CRUD methods...
}