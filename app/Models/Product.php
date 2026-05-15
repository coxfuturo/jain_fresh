<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'productId',
        'name',
        'image',
        'weight',

        'category_id',
        'delivery_time',
        'shelf_life',
        'stock_status',

        'nutrition',
        'storage_tips',

        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

   protected $casts = [

    'image' => 'array',

    'weight' => 'array'
];
}
