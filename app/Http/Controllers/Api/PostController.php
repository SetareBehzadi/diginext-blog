<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\CreatePostResource;
use App\Http\Resources\ShowPostResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(PostRequest $request)
    {
        $request['user_id'] = $request->header('User-ID');

        try {
            $post = Post::create($request->all());
            return response()->json(['id'=> $post->id],201);
        }
        catch (\Exception $e){
            return response()->json( $e,400);
        }
    }

    public function show($id)
    {
        $post = Post::find($id);
        if (!$post){
            return response()->json([],404);
        }
        return new ShowPostResource($post);
    }

    public function comment($id,Request $request)
    {
        try {
            $request['user_id'] = $request->header('User-ID');
            $post = Post::find($id);
            $comment = new Comment;
            $comment->user_id = $request['user_id'];
            $comment->text = $request->text;
            $post->comments()->save($comment);
            return response()->json( [],201);

        }catch (\Exception $e){
            return response()->json([],400);
        }

    }
}
