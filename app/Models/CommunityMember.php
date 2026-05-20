<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class CommunityMember extends Model
{
    use HasFactory, Notifiable;
    use HasPushSubscriptions;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'address',
    ];
}
