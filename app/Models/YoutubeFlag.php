<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeFlag extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'api_key',
        'is_live',
    ];
}
