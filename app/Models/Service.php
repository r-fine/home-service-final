<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'pricing',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(ReviewRating::class);
    }

    public function avgReviewRating()
    {
        $value = $this->reviews()->avg('rating');
        return round($value, 1);
    }

    public function countReviewRating()
    {
        return $this->reviews()->count();
    }
}
