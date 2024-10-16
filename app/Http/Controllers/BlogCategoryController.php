<?php

namespace App\Http\Controllers;


use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        BlogCategory::create($request->all());
        return redirect()->route('categories.index');
    }

    // Other CRUD methods...
}