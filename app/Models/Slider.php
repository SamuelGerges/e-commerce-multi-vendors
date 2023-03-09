<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    //

    public function getImageAttribute($val)
    {

        return $val ? asset('assets/images/sliders/'.$val) : '';
    }

}
