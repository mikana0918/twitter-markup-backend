<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Tweet
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class Tweet extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(FavoriteTweet::class, 'tweet_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function mentions(): HasMany
    {
        return $this->hasMany(MentionOfTweet::class, 'tweet_id','id');
    }

    /**
     * @return HasMany
     */
    public function retweets(): HasMany
    {
        return $this->hasMany(ReTweet::class, 'tweet_id','id');
    }

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(TweetAttachment::class, 'tweet_id', 'id');
    }
}
