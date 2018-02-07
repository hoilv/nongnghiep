<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ItemProduct extends Model
{
    use SoftDeletes;

    protected $table = 'items_products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_product_id', 'title', 'content', 'image', 'author'
    ];
}