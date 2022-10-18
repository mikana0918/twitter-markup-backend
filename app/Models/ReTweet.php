<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class ReTweet extends Model
{
    use HasFactory;


    protected $fillable = [
        'tweet_id',
        're_tweet_id'
    ];
    
    public function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class, 'tweet_id', 'id');
    }
}
