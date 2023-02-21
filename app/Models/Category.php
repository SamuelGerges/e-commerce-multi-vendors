<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Translatable;

    protected $fillable = ['parent_id', 'slug', 'is_active'];
    protected $with = ['translations'];
    protected $hidden = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function getActive()
    {
        return  $this->is_active === false ? __('admin/mainCategories/category.not_active') : __('admin/mainCategories/category.active');

    }

    public function mainCategory()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

}
