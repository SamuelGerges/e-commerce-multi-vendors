<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    use HasFactory;

    public $table = 'verification_codes';

    protected $fillable = ['user_id','code','created_at','updated_at'];



    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }



}
