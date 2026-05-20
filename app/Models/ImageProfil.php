<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProfil extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_url',
        'status',
        'profil_id'
    ];
    public function profil()
    {
        return $this->belongsTo(Profil::class,'profil_id');
    }

}
