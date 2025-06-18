<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Branch;
class Product extends Model
{
    protected $fillable = ['name', 'cost', 'price', 'category_id', 'branch_id'];


    /**
     * Get the branch that owns the product.
     */
    public function category()
{
    return $this->belongsTo(Category::class);
}

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
