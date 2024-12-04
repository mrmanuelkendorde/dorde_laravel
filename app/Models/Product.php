<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_image',
        'product_name',
        'catergory_id',
        'price',
        'stocks',
        'is_deleted',
    ];

    public function category()
        {
            return $this->belingsTo(Category::class, 'category_id');
        }
}
