<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'address',
        'type',
        'logo',
        'user_id'
    ];

    public function images()
    {
        return $this->hasMany(ImageProfil::class,'profil_id');
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
}
