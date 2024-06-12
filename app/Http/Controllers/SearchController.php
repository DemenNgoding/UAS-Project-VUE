<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request ->get( key: 'keywords');

        $community = Community::query()
        ->where (column: 'name' , operator: 'like' , value: "%search%")
        ->orWhere (column: 'username' , operator: 'like', value: "%search%")
        ->get();

        $posts = Post::query()
        ->where (column: 'body' , operator: 'like' , value: "%search%")
        ->paginate(perPage: 20);

        $posts = PostResource:: collection($posts);
        if($request->wantsJson()){
            return $posts;  
        }

        return inertia('search' , [
            'posts' => $posts,
            'community' => communityResource::collection($community)
        ]);
    }
}

