<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        
        $posts = Post::query()
            ->withCount('reactions')
            ->withCount('comments')
            ->with([
                // 'latest5Comments' => function($query)
                // {
                //     $query->latest()->take(5);
                // },
                'reactions' => function($query) use ($userId){
                $query->where('user_id', $userId);
            }])
            ->latest()
            ->paginate(20);
        return inertia::render('Dashboard', ['posts' => PostResource::collection($posts)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
