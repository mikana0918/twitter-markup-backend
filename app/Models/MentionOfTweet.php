<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class MentionOfTweet extends Model
{
    use HasFactory;

    public function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class, 'tweet_id', 'id');
    }
}
