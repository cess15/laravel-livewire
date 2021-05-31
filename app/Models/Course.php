<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

class Course extends Model
{
    use HasFactory;

    /**
     * Accesor
     * This function permit extract part of string of the attribute and return
     * @return string
    */
    public function getExcerptAttribute(): string
    {
        return substr($this->description, 0, 80) . "...";
    }

    /**
     * This method that should return courses similar with the himself user
     * @return Collection
    */
    public function similar(): Collection
    {
        return $this->where('category_id', $this->category_id)->with('user')->take(2)->get();
    }

    /**
     * This method that should be related with Post
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * This method that should be related with User
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
