<?php

namespace BloomCU\Categories\Scopes;

trait HasCategoryScopes
{
    // Check that model has category provided
    // public function scopeWithAllTags($query, array $tags)
    // {
    //     foreach ($tags as $tag) {
    //         $query->hasTags([$tag]);
    //     }
    //
    //     return $query;
    // }

    // public function scopeHasTags($query, array $tags)
    // {
    //     return $query->whereHas('tags', function ($query) use ($tags) {
    //         return $query->whereIn('slug', $tags);
    //     });
    // }
}
