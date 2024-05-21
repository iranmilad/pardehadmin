<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Scope a query to search products by name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByName(Builder $query, $term)
    {
        return $query->where('name', 'like', '%' . $term . '%');
    }

    /**
     * Scope a query to search products by category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByCategory(Builder $query, $category)
    {
        return $query->whereHas('category', function ($q) use ($category) {
            $q->where('name', 'like', '%' . $category . '%');
        });
    }

    // اضافه کردن متد‌های دیگر برای جستجو بر اساس سایر معیارها اینجا امکان پذیر است
}
