<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ProductVariation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['size','color','price','quantity'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_variations';

    public function scopMinPrice($query)
    {
        return $query->min('price');
    }
  
  
}
