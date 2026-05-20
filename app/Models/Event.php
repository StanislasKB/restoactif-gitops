<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'description',
        'address',
        'start_date',
        'end_date',
        'user_id'
    ];

    public function images()
    {
        return $this->hasMany(ImageEvent::class,'event_id');
    }

    public function principal_image()
    {
        if($this->images()->where('status', 1)->first()!=null)
        {
            return $this->images()->where('status', 1)->first();
        }
        else{
            return $this->images()->where('status', 0)->first();
        }

    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function reviews()
    {
        return $this->hasMany(EventReview::class,'event_id');
    }

}
