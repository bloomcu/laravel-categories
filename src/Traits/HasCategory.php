<?php

namespace BloomCU\Categories\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

use BloomCU\Categories\Models\Category;
use BloomCU\Categories\Scopes\HasCategoryScopes;

trait HasCategory
{
    use HasCategoryScopes;

    /**
     * The category this model belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Assign a category to this model.
    // public function categorize(string $category_id)
    // {
    //     return $this->category = $category_id;
    // }

    // Remove category.
    // public function uncategorize()
    // {
    //     return $this->detachTags($this->getTagModels($tags));
    // }

    // Get category from database, by their slug
    // private function getCategoryModel(array $tags)
    // {
    //     return Category::whereIn('slug', $this->normaliseCategoryNames($tags))->get();
    // }

    // Convert any tag names to slugs
    // private function normaliseTagNames(array $tags)
    // {
    //     return array_map(function ($tag) {
    //         return Str::slug($tag);
    //     }, $tags);
    // }
}
