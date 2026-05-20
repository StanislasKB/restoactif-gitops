<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageOffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_url',
        'status',
        'offer_id'
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class,'offer_id');
    }
}
