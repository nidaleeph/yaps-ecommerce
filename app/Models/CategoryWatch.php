<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class CategoryWatch extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;

    // protected $table = "categories_watch";

    protected $fillable = ['name', 'slug', 'active', 'parent_id', 'created_by', 'updated_by'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function parent()
    {
        return $this->belongsTo(CategoryWatch::class);
    }

    public function watch()
    {
        return $this->belongsToMany(Watch::class); // product_category

    }

    public static function getActiveAsTree($resourceClassName = null)
    {
        $categoriesWatch = CategoryWatch::where('active', true)->orderBy('parent_id')->get();
        return self::buildCategoryTree($categoriesWatch, null, $resourceClassName);
    }

    public static function getAllChildrenByParent(CategoryWatch $categoryWatch)
    {
        $categoriesWatch = CategoryWatch::where('active', true)->orderBy('parent_id')->get();
        $result[] = $categoryWatch;
        self::getCategoriesArray($categoriesWatch, $categoryWatch->id, $result);

        return $result;
    }

    private static function buildCategoryTree($categoriesWatch, $parentId = null, $resourceClassName = null)
    {
        $categoryWatchTree = [];

        foreach ($categoriesWatch as $categoryWatch) {
            if ($categoryWatch->parent_id === $parentId) {
                $children = self::buildCategoryTree($categoriesWatch, $categoryWatch->id, $resourceClassName);
                if ($children) {
                    $categoryWatch->setAttribute('children', $children);
                }
                $categoryWatchTree[] = $resourceClassName ? new $resourceClassName($categoryWatch) : $categoryWatch;
            }
        }

        return $categoryWatchTree;
    }

    private static function getCategoriesArray($categoriesWatch, $parentId, &$result)
    {
        foreach ($categoriesWatch as $categoryWatch) {
            if ($categoryWatch->parent_id === $parentId) {
                $result[] = $categoryWatch;
                self::getCategoriesArray($categoriesWatch, $categoryWatch->id, $result);
            }
        }
    }

}
