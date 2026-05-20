<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name',
        'first_name',
        'review_title',
        'review',
        'rating',
        'menu_id'
    ];


    public function images()
    {
        return $this->hasMany(ImageMenuReview::class,'menu_review_id');
    }
}
