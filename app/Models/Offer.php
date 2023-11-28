<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image' , 'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    public function setImageAttribute ($image)
    {
        $newImageName = uniqid() . '_' . 'image' . '.' . $image->extension();
        $image->move(public_path('images/offers') , $newImageName);
        return $this->attributes['image'] ='/'.'images/offers'.'/' . $newImageName;
    }


}
