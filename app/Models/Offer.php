<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'user_id'
    ];

    public function offer_images()
    {
        return $this->hasMany(ImageOffer::class,'offer_id');
    }


    public function principal_image()
    {
        if($this->offer_images()->where('status', 1)->first()!=null)
        {
            return $this->offer_images()->where('status', 1)->first();
        }
        else{
            return $this->offer_images()->where('status', 0)->first();
        }

    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
