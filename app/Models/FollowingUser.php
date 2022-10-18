<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class FollowingUser extends Model
{
    use HasFactory;

    protected $table = 'user_following_user';
}
