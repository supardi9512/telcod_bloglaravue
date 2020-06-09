<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function getHomepagePosts()
    {
        $posts = Post::orderBy('id', 'asc')->latest()->get();

        return response()->json($posts);
    }

    public function getCategories()
    {
        return Category::latest()->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'asc')->with('category')->latest()->paginate(3);
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);

        $post = new Post;
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->body = $request->body;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->title, '-').'.'.$image->getClientOriginalExtension();
            $location = public_path('/images');
            $image->move($location, $name);
            $post->image = $name;
        }

        $post->category_id = $request->category_id;

        $post->save();

        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Post::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'body' => 'required',
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->title, '-').'.'.$image->getClientOriginalExtension();
            $location = public_path('/images/');
            $image->move($location, $name);
            $oldImage = $post->image;
            \Storage::delete($oldImage);
            $post->image = $name;
        }

        $post->category_id = $request->category_id;

        $post->save();

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete($post->image);
        $post->delete();

        return response()->json($post);
    }
}
