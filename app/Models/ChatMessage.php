<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'message','status','chat_id','admin_id','image'
    ];
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveAImage($value,'/uploaded_images/');
    }
    public function chat(){
        return $this->belongsTo(Chat::class,'chat_id');
    }  
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }  
}
