<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'first_name',
        'last_name',
        'phone',
        'email',
        'address_line',
        'address_line_2',
        'town_city',
        'order_note',
        'date',
        'time'
    ];

    protected $casts = [
        'is_ordered' => 'boolean',
        'date' => 'date:Y-m-d',
        'created_at' => 'datetime',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullAddress()
    {
        return $this->address_line . ' ' . $this->address_line_2;
    }
}
