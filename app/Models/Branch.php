<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'logo'];

    /**
     * Get the products for the branch.
     */
    public function products()
{
    return $this->hasMany(Product::class);
}
public function branch()
{
    return $this->belongsTo(Branch::class);
}

}
