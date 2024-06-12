<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Enums\CommunityUserRole;
use App\Http\Enums\CommunityUserStatus;
use App\Http\Resources\CommunityResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommunityRequest;

use App\Models\Community;
use App\Models\CommunityUser;

class CommunityController extends Controller
{
    //
    public function index(Request $request) {
        return inertia::render('CreateCommunity');
    }

    public function store(StoreCommunityRequest $request)
    {
        $data = $request -> validated();
        $data['user_id'] = Auth::id();
        $community = Community::create($data);

        $communityUserData = [
            'status' => CommunityUserStatus::APPROVED->value, 
            'role' => CommunityUserRole::ADMIN->value, 
            'user_id' => Auth::id(), 
            'group_id' => $community->id,
            'created_by' => Auth::id()
        ];

        CommunityUser::create($communityUserData);

        return response(new CommunityResource($community), 201);
    
        }
    
}
