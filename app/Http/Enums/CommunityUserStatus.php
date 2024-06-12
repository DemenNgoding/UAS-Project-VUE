<?php

namespace App\Http\Enums;

enum CommunityUserStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
}