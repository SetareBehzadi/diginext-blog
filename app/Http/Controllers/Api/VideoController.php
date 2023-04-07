<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Resources\CreateVideoResource;
use App\Http\Resources\ShowVideoResource;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function store(StoreVideoRequest $request)
    {
        $request['user_id'] = $request->header('User-ID');

        try {
            $video = Video::create($request->all());
            return response()->json(['id'=> $video->id],201);
        }
        catch (\Exception $e){
            return response()->json( $e,400);
        }
    }

    public function show($id)
    {
        $video = Video::find($id);
        if (!$video){
            return response()->json([],404);
        }
        return new ShowVideoResource($video);
    }

    public function comment($id,Request $request)
    {
        try {
            $request['user_id'] = $request->header('User-ID');
            $video = Video::find($id);
            $comment = new Comment;
            $comment->user_id = $request['user_id'];
            $comment->text = $request->text;
            $video->comments()->save($comment);
            return response()->json( [],201);

        }catch (\Exception $e){
            return response()->json([],400);
        }

    }
}
