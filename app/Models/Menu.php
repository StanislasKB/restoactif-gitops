<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'start_date',
        'end_date',
        'user_id'
    ];


    public function plats()
    {
        return $this->belongsToMany(Dish::class, 'menu_dishes', 'menu_id', 'dish_id');
    }
    public function images()
    {
        return $this->hasMany(ImageMenu::class,'menu_id');
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
        return $this->hasMany(MenuReview::class,'menu_id');
    }

}
