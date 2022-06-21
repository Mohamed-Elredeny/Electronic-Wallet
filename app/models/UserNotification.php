<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'user_notifications';
    protected $fillable = [
        'user_id',
        'notification_id',
        'read',
        'curent_number',
        'category_id'
    ];

    public function user(){
        return $this->belongsTo(Vendor::class,'user_id');
    }
    public function  category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function  notification(){
        return $this->belongsTo(Notification::class,'notification_id');
    }
}
