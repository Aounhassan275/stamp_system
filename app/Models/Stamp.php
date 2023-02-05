<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    protected $fillable = [
        'stamp_id','type','amount','description_id','applicant','guardian_type','guardian',
        'agent','address','issue_date','validity_date','amount_in_words','reason','vendor_id',
        'notes','image'
    ];
    
    protected $casts = [
        'issue_date' => 'datetime',
        'validity_date' => 'date',
    ];
    public function setImageAttribute($value){
        $this->attributes['image'] = ImageHelper::saveImage($value,'/uploaded_images/');
    }
    public function description(){
        return $this->belongsTo(Description::class,'description_id');
    } 
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }  
}
