<?php

namespace App\Http\Enums;

enum CommunityUserRole: string
{
    case ADMIN = 'admin';
    case USER = 'user';
}