<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageEventReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_url',
        'event_review_id'
    ];
}
