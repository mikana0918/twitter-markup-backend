<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class MentionOfTweet
 * @package App\Models
 *
 * @property int $id
 * @property int $tweet_id
 * @property int $mentioned_tweet_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class MentionOfTweet extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class, 'tweet_id', 'id');
    }
}