<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_url',
        'status',
        'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class,'event_id');
    }

}
