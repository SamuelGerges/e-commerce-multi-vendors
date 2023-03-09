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

    protected $hidden = ['translations'];
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

    public $translatedAttributes = ['name', 'description', 'short_description'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id')->withDefault();
    }
    public function hasStock($quantity)
    {

        return $this->quantity >= $quantity;
    }

    public function getTotal($converted = true)
    {
        return $total =  $this->special_price ?? $this -> price;
    }
    public function outOfStock()
    {
        return $this->quantity === 0;
    }

    public function inStock()
    {
        return $this->quantity >= 1;
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'product_id', 'id')->withDefault();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories')->select('id','parent_id','slug');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function wishlist()
    {
        return $this->belongsToMany(User::class, 'wishlists')->withTimestamps();
    }

    public function getActive()
    {
        return $this->is_active === false ? __('admin/categories/category.not_active') : __('admin/categories/category.active');

    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'slug', 'price', 'created_at');
    }

}
