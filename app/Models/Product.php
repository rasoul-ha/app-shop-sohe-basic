<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function entity()
    {
        return $this->morphOne(Entity::class, 'entitiable');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function addons()
    {
        return $this->belongsToMany(Addon::class, 'addon_product');
    }

    public function product_options()
    {
        return $this->hasMany(ProductVariation::class, 'product_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->using(OrderProductPivot::class);
    }
    
   

}
