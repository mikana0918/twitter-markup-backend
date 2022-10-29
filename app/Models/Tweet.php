<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'body'
    ];

    /**
     * @return HasMany
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(FavoriteTweet::class, 'tweet_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function mentions(): BelongsToMany
    {
        return $this->belongsToMany(Tweet::class, 'mention_of_tweets', 'mentioned_tweet_id', 'tweet_id');
    }

    public function retweets(): BelongsToMany
    {
        return $this->belongsToMany(Tweet::class, 're_tweets', 're_tweet_id', 'tweet_id');
    }

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(TweetAttachment::class, 'tweet_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
