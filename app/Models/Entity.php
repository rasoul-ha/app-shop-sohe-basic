<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
    ];
    public $timestamps = false;
    protected $table = "entity_images";


    public function entitiable()
    {
        return $this->morphTo();
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
