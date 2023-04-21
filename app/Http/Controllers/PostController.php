<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'body.required' => 'El body no es válido.',
    ];

    public function index()
    {      
           
           return new PostCollection(Post::paginate(10));
          
    }

    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return response()->json(new PostResource($post), 200);
        
    }


    public function store(Request $request)
    {

        $this->authorize('create', Post::class);

        $request->validate([
            'title' => 'required|string|unique:posts|max:255',
            'description' => 'required',
            'status' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id'
        ], self::$messages);

        $post = Post::create($request->all());
        return response()->json($post, 201);

        
    }

    public function update(Request $request, Post $post)
    {
       $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|unique:posts,title,' . $post->id . '|max:255',
            'description' => 'required',
            'status' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id'
        ], self::$messages);

        $post->update($request->all());
        return response()->json($post, 200);
    }

    
    public function delete(Request $request, Post $post)
    {
       $this->authorize('delete', $post);

        $post->delete();
        return response()->json(null, 204);
        
    }
}