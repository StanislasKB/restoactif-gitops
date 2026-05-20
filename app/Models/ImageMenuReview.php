<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageMenuReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_url',
        'menu_review_id'
    ];
}
