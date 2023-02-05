<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'admin_id','name','status'
    ];
    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }  
    public function messages()
    {
        return $this->hasMany(ChatMessage::class,'chat_id');
    }
}
