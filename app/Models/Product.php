<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'category',
        'description',
        'date_time',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->images->each(function ($image) {
                $image->delete();
            });
        });
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
