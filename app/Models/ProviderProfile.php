<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'first_name',
        'last_name',
        'profile_pic',
        'phone',
        'address_line',
        'address_line_2'
    ];

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullAddress()
    {
        return $this->address_line . ' ' . $this->address_line_2;
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
