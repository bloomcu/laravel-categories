<?php

namespace BloomCU\Categories\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    public static function booted()
    {
        static::creating(function (Category $category) {
            $category->slug = Str::slug($category->title);
        });
    }

    // public function setTitleAttribute($value)
    // {
    //     $this->attributes['title'] = $value;
    //     $this->attributes['slug'] = Str::slug($value);
    // }

    /**
     * Get only parent (top level) categories.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    /**
     * Get categories in order.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeOrdered(Builder $builder, $direction = 'asc')
    {
        $builder->orderBy('order', $direction);
    }

    /**
     * The parent category of this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * The children categories of this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
