<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class FollowedUser extends Model
{
    use HasFactory;

    protected $table = 'user_followed_by_user';
}
