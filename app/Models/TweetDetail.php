<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetDetail extends Model
{
    use HasFactory;

    protected $fillable = ['tweet_id', 'option', 'count'];
}