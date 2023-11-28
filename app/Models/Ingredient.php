<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,"image", 'name_ar' , 'total_quantity' , 'unit' ,'threshold'
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class,'product_ingredient')->withPivot('quantity','unit','is_remove');
    }
//    public function extraIngredient()
//    {
//        return $this->hasOne(ExtraIngredient::class);
//    }
//    public function orderProducts()
//    {
//        return $this->belongsToMany(OrderProduct::class, 'remove_ingredients')->withPivot('order_product_id','ingredient_id');
//    }
//    public function destruction()
//    {
//        return $this->hasMany(Destruction::class);
//    }
//    public function addition()
//    {
//        return $this->hasMany(Addition::class);
//    }
}
