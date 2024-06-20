<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostReaction;
use Illuminate\Http\Request;
use App\Http\Enums\PostReactionEnum;
use Illuminate\Validation\Rule;
use App\Http\Resources\CommentResource;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        Post::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
    
        $post->update($validated);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $id = Auth::id();

        if($post->user_id !== $id){
            return response("You don't have permission to delete this post", 403);
        }

        $post->delete();

        return back();
    }

    public function createComment(Request $request,Post $post)
    {
        $data = $request->validate([
            'comment' => ['required']
        ]);

        $comment = Comment::create([
            'post_id' => $post->id,
            'comment' => $data['comment'],
            'user_id' => Auth::id()
        ]);

        return response(new CommentResource($comment) , status:201);
    }


    public function postReaction(Request $request, Post $post)
    {
        $data = $request->validate([
            'reaction' => [Rule::enum(PostReactionEnum::class)]
        ]);

        $userId = Auth::id();
        $reaction = PostReaction::where('user_id', $userId)->where('post_id', $post->id)->first();

        if($reaction){
            $hasReaction = false;
            $reaction->delete();
            
        } else {
            $hasReaction = true;
            PostReaction::create([
                'post_id' => $post->id,
                'user_id' => Auth::id(),
                'type' => $data['reaction']
            ]);
        }

        $reactions = PostReaction::where('post_id', $post->id)->count();

        return response([
            'num_of_reactions' => $reactions,
            'current_user_has_reaction' => $hasReaction
        ]);
    }
}
