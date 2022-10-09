<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class FollowingUser
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $following_user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class FollowingUser extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_following_user';
}
