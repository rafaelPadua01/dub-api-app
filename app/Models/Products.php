<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
	protected $fillable = [
		'product_name', 
		'category_id',
		 'product_image',
		'product_price',
		'description_product',
		'product_quantity',
	];
}
