<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->subcategories()->with('children');
    }

    public function isRoot()
    {
        if (!$this->parent_id) {
            return 'yes';
        }
    }

    public function isParent()
    {
        if (!$this->parent_id) {
            return true;
        }
        return false;
    }

    public function hasChildren()
    {
        if ($this->children->count()) {
            return true;
        }
        return false;
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function providers()
    {
        return $this->hasMany(ProviderProfile::class);
    }
}
