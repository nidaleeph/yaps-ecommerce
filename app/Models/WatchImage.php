<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'watch_id',
        'path',
        'url',
        'mime',
        'size',
        'position',
    ];

    public function watch()
    {
        return $this->belongsTo(Watch::class);
    }
}
