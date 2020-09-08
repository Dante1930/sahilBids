<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Tag extends Model
{
	protected $primaryKey = 'id';

	protected $fillable = ['product_tags'];
    

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_tags');
    }

    
}
