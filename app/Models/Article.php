<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug'
    ];

    public function content()
    {
        return $this->belongsToMany(Content::class)->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot([
            'is_primary',
            'created_at',
            'updated_at'
        ]);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class)->withTimestamps();
    }

    public function filterByCategoryId($categoryId, $query = null)
    {
        $query = $query === null ? $this : $query;

        if ($categoryId != '0') {
            return $query->whereHas('categories', function ($query) use ($categoryId) {
                return $query->where([
                    'id' => $categoryId,
                    'is_primary' => true
                ]);
            });
        }

        return $query;
    }

    public function filterBySearchedText($searchedText, $query = null)
    {
        $query = $query === null ? $this : $query;

        if ($searchedText != '') {
            return $query->where(
                'title',
                'LIKE',
                '%' . $searchedText . '%'
            )->orWhere(function ($query) use ($searchedText) {
                $query->whereHas('content', function ($query) use ($searchedText) {
                    return $query->where('content', 'LIKE', '%' . $searchedText . '%');
                });
            });
        }

        return $query;
    }
}
