<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name',
        'first_name',
        'review_title',
        'review',
        'rating',
        'event_id'
    ];


    public function images()
    {
        return $this->hasMany(ImageEventReview::class,'event_review_id');
    }
}
