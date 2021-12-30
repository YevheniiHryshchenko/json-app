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
        return $this->belongsToMany(Content::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot([
            'is_primary',
            'number',
            'created_at',
            'updated_at'
        ]);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class);
    }
}
