<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Watch extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    // protected $table = "watch";
    protected $fillable = ['title', 'watch_code', 'description', 'url', 'subtitle', 'published', 'created_by', 'updated_by'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function images()
    {
        return $this->hasMany(WatchImage::class)->orderBy('position');
    }

    public function getImageAttribute()
    {
        return $this->images->count() > 0 ? $this->images->get(0)->url : null;
    }

    public function categoriesWatch()
    {
        return $this->belongsToMany(CategoryWatch::class, 'watch_categories');
    }

    public function event()
    {
        return $this->belongsTo(Events::class);
    }
}
