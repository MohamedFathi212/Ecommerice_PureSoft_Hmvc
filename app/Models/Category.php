<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // الحقول القابلة للتعديل
    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
        'updated_at' => 'datetime:d-m-Y H:i',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    public function getNameUpperAttribute()
    {
        return strtoupper($this->name);
    }


    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', "%{$term}%")->orWhere('description', 'LIKE', "%{$term}%");
    }
}
