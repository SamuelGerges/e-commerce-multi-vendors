<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Translatable, SoftDeletes;

    protected $with = ['translations'];
    protected $fillable = [
        'brand_id', 'slug', 'sku',
        'price', 'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'quantity',
        'in_stock',
        'is_active'
    ];

    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'special_price_start',
        'special_price_end',
        'start_date',
        'end_date',
        'deleted_at',
    ];

    public $translatedAttributes = ['name','description','short_description'];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id')->withDefault();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_categories','product_id','category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function getActive()
    {
        return  $this->is_active === false ? __('admin/categories/category.not_active') : __('admin/categories/category.active');

    }

    public function scopeSelection($query)
    {
        return $query->select('id','slug' ,'price', 'created_at');
    }

}
