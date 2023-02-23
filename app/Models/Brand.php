<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, Translatable;

    protected $with = ['translations'];
    protected $fillable = ['is_active', 'image'];
    protected $casts = [
        'is_active' => 'boolean'
    ];

    public $translatedAttributes = ['name'];

    public function getActive()
    {
        return $this->is_active === false ? __('admin/brands/brand.not_active') : __('admin/brands/brand.active');
    }

    public function getImageAttribute($image)
    {
        return ($image !== null) ? asset('assets/images/brands/' . $image) : '';
    }
}
