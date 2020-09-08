<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;

class Product extends Model
{
    protected $fillable = [
    	'title','description','image','layout_id','theme_id','shipping_details','payment_details',
    	'return_policy','additional_details'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'product_tags')->withTimestamps();
    }

}
