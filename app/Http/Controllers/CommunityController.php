<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Inertia\Inertia;
// use App\Http\Enums\CommunityUserRole;
// use App\Http\Enums\CommunityUserStatus;
// use App\Http\Resources\CommunityResource;
// use Illuminate\Support\Facades\Auth;
// use App\Http\Requests\StoreCommunityRequest;

// use App\Models\Community;
// use App\Models\CommunityUser;

// class CommunityController extends Controller
// {
//     //
//     public function index(Request $request) {
//         return inertia::render('CreateCommunity');
//     }

//     public function store(StoreCommunityRequest $request)
//     {
//         // $data = $request -> validated();
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'about' => 'required|string|max:255',
//         ]);
//         $data['user_id'] = Auth::id();
//         $community = Community::create($data);

//         $communityUserData = [
//             // 'status' => CommunityUserStatus::APPROVED->value, 
//             'role' => CommunityUserRole::ADMIN->value, 
//             'user_id' => Auth::id(), 
//             'auto_approval' => CommunityUserStatus::APPROVED->value,
//             'community_id' => $community->id,
//             'created_by' => Auth::id()
//         ];

//         CommunityUser::create($communityUserData);

//         return response(new CommunityResource($community), 201);
    
//         }
    
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Enums\CommunityUserRole;
use App\Http\Enums\CommunityUserStatus;
use App\Http\Resources\CommunityResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\ShowCommunityRequest;

use App\Models\Communities;
use App\Models\CommunityUser;

class CommunityController extends Controller
{
    public function store(StoreCommunityRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $community = Communities::create($data);

        $communityUserData = [
            'role' => CommunityUserRole::ADMIN->value,
            'status' => CommunityUserStatus::APPROVED->value,
            'user_id' => Auth::id(),
            'auto_approval' => $data['auto_approval'],
            'community_id' => $community->id,
            'created_by' => Auth::id()
        ];

        CommunityUser::create($communityUserData);

        return response(new CommunityResource($community), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowCommunityRequest $request)
    {
        $data = $request->validated();
        // $communities = Communities::where('user_id', $data['id'])->get();
        // $communities = Communities::where('user_id', $data->id)->get();
        $communities = Communities::where('user_id', Auth::id())->get();


        return response()->json($communities);
    }
}
